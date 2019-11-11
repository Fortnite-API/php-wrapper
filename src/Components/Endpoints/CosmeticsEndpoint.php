<?php

namespace MichelPi\FortniteApi\Components\Endpoints;

use MichelPi\FortniteApi\Components\HttpClient;
use MichelPi\FortniteApi\Components\Objects\Cosmetic;
use MichelPi\FortniteApi\Components\Tasks\CosmeticArrayTask;
use MichelPi\FortniteApi\Components\Tasks\CosmeticTask;
use MichelPi\FortniteApi\FortniteApi;
use MichelPi\FortniteApi\FortniteApiError;

/**
 * Provides access to the /cosmetics/ endpoint
 */
class CosmeticsEndpoint
{
    /**
     * Returns the requested cosmetic.
     *
     * @param string $cosmeticId
     * @param null|string $language
     * @return null|Cosmetic
     */
    public function get($cosmeticId, $language = null)
    {
        $promise = $this->getAsync($cosmeticId, $language);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Makes an async request for the specified cosmetic.
     *
     * @param string $cosmeticId
     * @param null|string $language
     * @return null|CosmeticTask
     */
    public function getAsync($cosmeticId, $language = null)
    {
        FortniteApiError::clearLastError();

        if (empty($cosmeticId)) {
            FortniteApiError::setLastError("CosmeticId can't be null or empty.");

            return null;
        }

        $path = "/cosmetics/br/".$cosmeticId;

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

        return new CosmeticTask($promise);
    }

    /**
     * Returns all cosmetics.
     *
     * @param null|string $language
     * @return null|Cosmetic[]|array
     */
    public function getAll($language = null)
    {
        $promise = $this->getAllAsync($language);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Makes an async request to retrieve all cosmetics.
     *
     * @param null|string $language
     * @return CosmeticArrayTask
     */
    public function getAllAsync($language = null)
    {
        FortniteApiError::clearLastError();

        $path = "/cosmetics/br";

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

        return new CosmeticArrayTask($promise);
    }

    /**
     * Returns the first cosmetic matching the search query
     *
     * @param array $query
     * @param null|string $language
     * @return null|Cosmetic
     */
    public function search($query, $language = null)
    {
        $promise = $this->searchAsync($query, $language);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Makes an async request for the first cosmetic matching the search query.
     *
     * @param array $query
     * @param null|string $language
     * @return null|CosmeticTask
     */
    public function searchAsync($query, $language = null)
    {
        FortniteApiError::clearLastError();

        $path = "/cosmetics/br/search";

        if (!empty($language)) {
            if (!in_array($language, FortniteApi::getSupportedLanguages())) {
                FortniteApiError::setLastError("The given language is not supported by this api.");

                return null;
            }

            $query["language"] = $language;
        }

        $promise = HttpClient::getInstance()->getAsync($path, [
            "query" => $query
        ]);

        return new CosmeticTask($promise);
    }

    /**
     * Returns all cosmetics matching the given search query.
     *
     * @param array $query
     * @param null|string $language
     * @return null|Cosmetic[]|array
     */
    public function searchAll($query, $language = null)
    {
        $promise = $this->searchAllAsync($query, $language);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Makes an async request to search for all cosmetics matching the given search query.
     *
     * @param array $query
     * @param null|string $language
     * @return null|CosmeticArrayTask
     */
    public function searchAllAsync($query, $language = null)
    {
        FortniteApiError::clearLastError();

        $path = "/cosmetics/br/search/all";

        if (!empty($language)) {
            if (!in_array($language, FortniteApi::getSupportedLanguages())) {
                FortniteApiError::setLastError("The given language is not supported by this api.");

                return null;
            }

            $query["language"] = $language;
        }

        $promise = HttpClient::getInstance()->getAsync($path, [
            "query" => $query
        ]);

        return new CosmeticArrayTask($promise);
    }

    /**
     * Returns all cosmetics matching the given id(s).
     *
     * @param string|array $ids
     * @param null|string $language
     * @return null|Cosmetic[]
     */
    public function searchIds($ids, $language = null)
    {
        $promise = $this->searchIdsAsync($ids, $language);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Makes an async request to get all cosmetics matching the given id(s).
     *
     * @param string|array $ids
     * @param null|string $language
     * @return null|CosmeticArrayTask
     */
    public function searchIdsAsync($ids, $language = null)
    {
        FortniteApiError::clearLastError();

        if (empty($ids)) {
            FortniteApiError::setLastError("The ids parameter is required.");

            return null;
        }

        if (!is_array($ids)) {
            $ids = array($ids);
        }

        $path = "/cosmetics/br/search/ids";

        $query = [];
        
        $query["id"] = $ids;

        if (!empty($language)) {
            if (!in_array($language, FortniteApi::getSupportedLanguages())) {
                FortniteApiError::setLastError("The given language is not supported by this api.");

                return null;
            }

            $query["language"] = $language;
        }

        $promise = HttpClient::getInstance()->getAsync($path, [
            "query" => $query
        ]);

        return new CosmeticArrayTask($promise);
    }
}
