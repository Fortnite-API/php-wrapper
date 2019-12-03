<?php

namespace FortniteApi\Components\Endpoints;

use FortniteApi\Components\Tasks\ShopTask;
use FortniteApi\FortniteApi;
use FortniteApi\FortniteApiError;

use GuzzleHttp\Client;

/**
 * Provides access to the /shop/ endpoint.
 */
class ShopEndpoint
{
    /**
     * Undocumented variable
     *
     * @var Client
     */
    private $httpClient;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Returns the current battle royale shop.
     *
     * @param null|string $language
     * @return null|Shop
     */
    public function get($language = null)
    {
        $promise = $this->getAsync($language);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Makes an async request for the current battle royale shop.
     *
     * @param null|string $language
     * @return null|Shop
     */
    public function getAsync($language = null)
    {
        FortniteApiError::clearLastError();

        $path = "/shop/br";

        $query = [];

        if (!empty($language)) {
            if (!in_array($language, FortniteApi::getSupportedLanguages())) {
                FortniteApiError::setLastError("The given language is not supported by this api.");

                return null;
            }

            $query["language"] = $language;
        }

        if (count($query) == 0) {
            $promise = $this->httpClient->getAsync($path);
        } else {
            $promise = $this->httpClient->getAsync($path, [
                "query" => $query
            ]);
        }

        return new ShopTask($promise);
    }
}
