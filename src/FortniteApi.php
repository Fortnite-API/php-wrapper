<?php

namespace MichelPi\FortniteApi;

use MichelPi\FortniteApi\Components\Endpoints\CosmeticsEndpoint;
use MichelPi\FortniteApi\Components\Endpoints\NewsEndpoint;
use MichelPi\FortniteApi\Components\Endpoints\ShopEndpoint;
use MichelPi\FortniteApi\Config\Config;

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
     * Constructs a new FortniteApi instance.
     */
    public function __construct()
    {
        $this->cosmetics = new CosmeticsEndpoint();
        $this->shop = new ShopEndpoint();
        $this->news = new NewsEndpoint();
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
