<?php

namespace FortniteApi\Components\Endpoints;

use FortniteApi\Components\Objects\Cosmetic;
use FortniteApi\Components\Tasks\CosmeticArrayTask;
use FortniteApi\Components\Tasks\CosmeticTask;
use FortniteApi\FortniteApi;
use FortniteApi\FortniteApiError;

use GuzzleHttp\Client;

/**
 * Provides access to the /cosmetics/ endpoint
 */
class CosmeticsEndpoint
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
            $promise = $this->httpClient->getAsync($path);
        } else {
            $promise = $this->httpClient->getAsync($path, [
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
            $promise = $this->httpClient->getAsync($path);
        } else {
            $promise = $this->httpClient->getAsync($path, [
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

        $promise = $this->httpClient->getAsync($path, [
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

        $promise = $this->httpClient->getAsync($path, [
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

        $promise = $this->httpClient->getAsync($path, [
            "query" => $query
        ]);

        return new CosmeticArrayTask($promise);
    }
}
