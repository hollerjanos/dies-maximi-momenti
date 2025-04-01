<?php

namespace Http;

class StatusCode
{
    // Successful responses

    public static function ok(): int
    {
        return 200;
    }

    public static function created(): int
    {
        return 201;
    }

    // Client error responses

    public static function badRequest(): int
    {
        return 400;
    }

    public static function unauthorized(): int
    {
        return 401;
    }

    public static function notFound(): int
    {
        return 404;
    }

    public static function methodNotAllowed(): int
    {
        return 405;
    }

    public static function conflict(): int
    {
        return 409;
    }

    // Server error responses

    public static function internalServerError(): int
    {
        return 500;
    }
}
