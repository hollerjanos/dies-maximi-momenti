<?php

namespace Http\StatusCode;

trait ClientErrorResponse
{
    public const int BAD_REQUEST = 400;

    public const int UNAUTHORIZED = 401;

    public const int NOT_FOUND = 404;

    public const int METHOD_NOT_ALLOWED = 405;

    public const int CONFLICT = 409;
}
