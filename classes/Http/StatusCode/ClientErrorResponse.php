<?php

namespace Http\StatusCode;

trait ClientErrorResponse
{
    /**
     * Bad request
     *
     * @var int
     */
    public const BAD_REQUEST = 400;

    /**
     * Unauthorized
     *
     * @var int
     */
    public const UNAUTHORIZED = 401;

    /**
     * Not found
     *
     * @var int
     */
    public const NOT_FOUND = 404;

    /**
     * Method not allowed
     *
     * @var int
     */
    public const METHOD_NOT_ALLOWED = 405;

    /**
     * Method not allowed
     *
     * @var int
     */
    public const CONFLICT = 409;
}

