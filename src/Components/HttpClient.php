<?php

namespace FortniteApi\Components;

class HttpClient
{
    public static function isSuccess($statusCode)
    {
        if (empty($statusCode) || !is_int($statusCode)) {
            return false;
        }

        return $statusCode >= 200 && $statusCode < 400;
    }
}
