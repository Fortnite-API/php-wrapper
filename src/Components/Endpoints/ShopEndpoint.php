<?php

namespace MichelPi\FortniteApi\Components\Endpoints;

use MichelPi\FortniteApi\Components\HttpClient;
use MichelPi\FortniteApi\Components\Tasks\ShopTask;
use MichelPi\FortniteApi\FortniteApi;
use MichelPi\FortniteApi\FortniteApiError;

/**
 * Provides access to the /shop/ endpoint.
 */
class ShopEndpoint
{
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
            $promise = HttpClient::getInstance()->getAsync($path);
        } else {
            $promise = HttpClient::getInstance()->getAsync($path, [
                "query" => $query
            ]);
        }

        return new ShopTask($promise);
    }
}
