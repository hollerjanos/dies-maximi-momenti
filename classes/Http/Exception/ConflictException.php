<?php

namespace Http\Exception;

require_once __DIR__ . "/RequestException.php";
require_once __DIR__ . "/../StatusCode.php";

use Http\Exception\RequestException;
use Http\StatusCode;

class ConflictException extends RequestException
{
    public function __construct()
    {
        $message = "Duplicated value!";
        $code = StatusCode::CONFLICT;

        parent::__construct($message, $code);
    }
}

