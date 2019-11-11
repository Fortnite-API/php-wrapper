<?php

namespace MichelPi\FortniteApi\Config;

class Config
{
    private static $supportedLanguages = [
        "ar",
        "de",
        "en",
        "es",
        "es-419",
        "fr",
        "it",
        "ja",
        "ko",
        "pl",
        "pt-BR",
        "ru",
        "tr",
        "zh-CN",
        "zh-Hant"
    ];

    private static $httpClientConfig = [
        "base_uri" => "https://fortnite-api.com",
        "allow_redirects" => true,
        "connect_timeout" => 30,
        "timeout" => 30
    ];

    public static function getSupportedLanguages()
    {
        return self::$supportedLanguages;
    }

    public static function getHttpClientConfig()
    {
        return self::$httpClientConfig;
    }

    public static function getBaseUri()
    {
        return self::$httpClientConfig["base_uri"];
    }
}
