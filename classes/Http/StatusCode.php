<?php

namespace Http;

require_once __DIR__ . "/StatusCode/SuccessfulResponse.php";
require_once __DIR__ . "/StatusCode/ClientErrorResponse.php";
require_once __DIR__ . "/StatusCode/ServerErrorResponse.php";

use Http\StatusCode\SuccessfulResponse;
use Http\StatusCode\ClientErrorResponse;
use Http\StatusCode\ServerErrorResponse;

class StatusCode
{
    use SuccessfulResponse;
    use ClientErrorResponse;
    use ServerErrorResponse;
}

