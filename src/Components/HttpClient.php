<?php

namespace MichelPi\FortniteApi\Components;

use GuzzleHttp\Client;
use MichelPi\FortniteApi\Config\Config;

class HttpClient
{
    /**
     * Undocumented variable
     *
     * @var Client
     */
    private static $_client;

    public static function isSuccess($statusCode)
    {
        if (empty($statusCode) || !is_int($statusCode)) {
            return false;
        }

        return $statusCode >= 200 && $statusCode < 400;
    }

    /**
     * Undocumented function
     *
     * @return Client
     */
    public static function getInstance()
    {
        if (empty(self::$_client)) {
            self::$_client = new Client(Config::getHttpClientConfig());
        }

        return self::$_client;
    }
}
