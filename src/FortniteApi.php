<?php

namespace FortniteApi;

use FortniteApi\Components\Endpoints\CosmeticsEndpoint;
use FortniteApi\Components\Endpoints\CreatorCodeEndpoint;
use FortniteApi\Components\Endpoints\NewsEndpoint;
use FortniteApi\Components\Endpoints\ShopEndpoint;

use GuzzleHttp\Client;

/**
 * Provides access to https://fortnite-api.com
 */
class FortniteApi
{
    /**
     * Undocumented variable
     *
     * @var string|null
     */
    private $apiKey;

    /**
     * Undocumented variable
     *
     * @var Client
     */
    private $httpClient;

    /**
     * @inheritDoc
     *
     * @var CosmeticsEndpoint $cosmetics
     */
    public $cosmetics;
    /**
     * @inheritDoc
     *
     * @var ShopEndpoint $shop
     */
    public $shop;
    /**
     * @inheritDoc
     *
     * @var NewsEndpoint $news
     */
    public $news;

    /**
     * @inheritDoc
     *
     * @var CreatorCodeEndpoint $creatorCode
     */
    public $creatorCode;

    /**
     * Constructs a new FortniteApi instance.
     */
    public function __construct($apiKey)
    {
        if ($apiKey === null || $apiKey === false) {
            $apiKey = "";
        }

        $this->httpClient = new Client([
            "base_uri" => self::getBaseUri(),
            "allow_redirects" => true,
            "connect_timeout" => 30,
            "timeout" => 30,
            "headers" => [
                "x-api-key" => $apiKey
            ]
        ]);

        $this->apiKey = $apiKey;

        $this->cosmetics = new CosmeticsEndpoint($this->httpClient);
        $this->shop = new ShopEndpoint($this->httpClient);
        $this->news = new NewsEndpoint($this->httpClient);
        $this->creatorCode = new CreatorCodeEndpoint($this->httpClient);
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Returns the base uri all requests use.
     *
     * @return string
     */
    public static function getBaseUri()
    {
        return "https://fortnite-api.com";
    }

    /**
     * Returns all supported languages that can be used with this api.
     *
     * @return string[]|array
     */
    public static function getSupportedLanguages()
    {
        return [
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
    }
}
