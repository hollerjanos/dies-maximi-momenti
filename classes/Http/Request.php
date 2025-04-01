<?php

namespace Http;

require_once(__DIR__ . "/../../includes/constants.php");
require_once(__DIR__ . "/StatusCode.php");

class Request
{
    private string $apiKey = "";
    private string $method = "";

    private int $code;
    private string $message;

    public function __construct()
    {
        $this->code = StatusCode::badRequest();
        $this->message = "Request has not been processed yet!";

        $this->apiKey = $_SERVER["PHP_AUTH_USER"] ?? "";
        $this->method = $_SERVER["REQUEST_METHOD"] ?? "";
    }

    public function checkAuthorizations(): void
    {
        if ($this->apiKey !== API_KEY)
        {
            $this->setCode(StatusCode::unauthorized());
            $this->setMessage("Unauthorized request!");

            throw new RequestException($this->message, $this->code);
        }
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function success(string $message): void
    {
        $this->setCode(StatusCode::ok());
        $this->setMessage($message);
    }

    public function failure(string $message): void
    {
        $this->setCode(StatusCode::badRequest());
        $this->setMessage($message);
    }

    public function methodNotAllowed(): void
    {
        $this->setCode(StatusCode::methodNotAllowed());
        $this->setMessage("Method not allowed!");
    }

    public function printResult(): void
    {
        echo json_encode([
            "code" => $this->code,
            "message" => $this->message
        ]);
    }

    public function setHttpResponseCode(): void
    {
        http_response_code($this->code);
    }
}
