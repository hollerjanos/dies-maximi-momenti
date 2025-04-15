<?php

namespace Http;

require_once(__DIR__ . "/../../includes/constants.php");
require_once(__DIR__ . "/StatusCode.php");
require_once(__DIR__ . "/Exception/UnauthorizedException.php");

use Http\StatusCode;
use Http\Exception\UnauthorizedException;

class Request
{
    /**
     * Code
     *
     * @var int
     */
    private int $code;

    /**
     * Message
     *
     * @var string
     */
    private string $message;

    /**
     * API key
     *
     * @var string
     */
    private string $apiKey;

    /**
     * Method
     *
     * @var string
     */
    private string $method;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->code = StatusCode::BAD_REQUEST;
        $this->message = "Request has not been processed yet!";

        $this->apiKey = $_SERVER["PHP_AUTH_USER"] ?? "";
        $this->method = $_SERVER["REQUEST_METHOD"] ?? "";
    }

    /**
     * Check authorizations
     *
     * @return void
     *
     * @throws UnauthorizedException If the API key is invalid.
     */
    public function checkAuthorizations(): void
    {
        if ($this->apiKey !== API_KEY)
        {
            throw new UnauthorizedException();
        }
    }

    /**
     * Set code
     *
     * @param int $code Value of the code.
     *
     * @return void
     */
    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * Set message
     *
     * @param string $message Value of the message.
     *
     * @return void
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Get method
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Print result
     *
     * @return void
     */
    public function printResult(): void
    {
        echo json_encode([
            "code" => $this->code,
            "message" => $this->message
        ]);
    }

    /**
     * Send header
     *
     * @return void
     */
    public function sendHeader(): void
    {
        header(
            "Content-Type: application/json; Charset=utf-8",
            true,
            $this->code
        );
    }
}

