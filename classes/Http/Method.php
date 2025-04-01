<?php

namespace Http;

class Method
{
    public static function get(): string
    {
        return "GET";
    }

    public static function post(): string
    {
        return "POST";
    }

    public static function put(): string
    {
        return "PUT";
    }

    public static function delete(): string
    {
        return "DELETE";
    }
}
