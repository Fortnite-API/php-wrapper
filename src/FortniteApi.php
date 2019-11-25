<?php

namespace FortniteApi;

use FortniteApi\Components\Endpoints\CosmeticsEndpoint;
use FortniteApi\Components\Endpoints\CreatorCodeEndpoint;
use FortniteApi\Components\Endpoints\NewsEndpoint;
use FortniteApi\Components\Endpoints\ShopEndpoint;
use FortniteApi\Config\Config;

/**
 * Provides access to https://fortnite-api.com
 */
class FortniteApi
{
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
    public function __construct()
    {
        $this->cosmetics = new CosmeticsEndpoint();
        $this->shop = new ShopEndpoint();
        $this->news = new NewsEndpoint();
        $this->creatorCode = new CreatorCodeEndpoint();
    }

    /**
     * Returns the base uri all requests use.
     *
     * @return string
     */
    public static function getBaseUri()
    {
        return Config::getBaseUri();
    }

    /**
     * Returns all supported languages that can be used with this api.
     *
     * @return string[]|array
     */
    public static function getSupportedLanguages()
    {
        return Config::getSupportedLanguages();
    }
}
