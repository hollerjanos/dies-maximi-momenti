<?php

namespace Http\Exception;

require_once __DIR__ . "/RequestException.php";
require_once __DIR__ . "/../StatusCode.php";

use Http\Exception\RequestException;
use Http\StatusCode;

class UnauthorizedException extends RequestException
{
    public function __construct()
    {
        $message = "Unauthorized request!";
        $code = StatusCode::UNAUTHORIZED;

        parent::__construct($message, $code);
    }
}

