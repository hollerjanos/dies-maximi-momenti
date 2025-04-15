<?php

namespace Http\Exception;

require_once __DIR__ . "/RequestException.php";
require_once __DIR__ . "/../StatusCode.php";

use Http\Exception\RequestException;
use Http\StatusCode;

class MethodNotAllowedException extends RequestException
{
    public function __construct()
    {
        $message = "Method not allowed!";
        $code = StatusCode::METHOD_NOT_ALLOWED;

        parent::__construct($message, $code);
    }
}

