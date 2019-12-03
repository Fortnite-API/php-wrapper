<?php

namespace FortniteApi\Components\Endpoints;

use FortniteApi\Components\Tasks\CreatorCodeArrayTask;
use FortniteApi\Components\Tasks\CreatorCodeTask;
use FortniteApi\FortniteApiError;

use GuzzleHttp\Client;

/**
 * Provides access to the /creatorcode endpoint.
 */
class CreatorCodeEndpoint
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
     * Returns the creator code data for a given slug.
     *
     * @param string|array|mixed $slug
     * @return null|CreatorCode
     */
    public function get($slug)
    {
        $promise = $this->getAsync($slug);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Returns the creator code data for a given slug.
     *
     * @param string|array|mixed $slug
     * @return null|CreatorCodeTask
     */
    public function getAsync($slug)
    {
        FortniteApiError::clearLastError();

        if (empty($slug)) {
            FortniteApiError::setLastError("Missing paramter 'slug'.");

            return null;
        }

        $path = "/creatorcode";

        $query = [
            "slug" => $slug
        ];

        $promise = $this->httpClient->getAsync($path, [
            "query" => $query
        ]);

        return new CreatorCodeTask($promise);
    }

    /**
     * Returns the first creator code matching the given slug.
     *
     * @param string|array|mixed $slug
     * @return null|CreatorCode
     */
    public function search($slug)
    {
        $promise = $this->searchAsync($slug);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Returns the first creator code matching the given slug.
     *
     * @param string|array|mixed $slug
     * @return null|CreatorCodeTask
     */
    public function searchAsync($slug)
    {
        FortniteApiError::clearLastError();

        if (empty($slug)) {
            FortniteApiError::setLastError("Missing paramter 'slug'.");

            return null;
        }

        $path = "/creatorcode/search";

        $query = [
            "slug" => $slug
        ];

        $promise = $this->httpClient->getAsync($path, [
            "query" => $query
        ]);

        return new CreatorCodeTask($promise);
    }

    /**
     * Returns the all creator codes matching the given slug.
     *
     * @param string|array|mixed $slug
     * @return null|CreatorCode[]|array|mixed
     */
    public function searchAll($slug)
    {
        $promise = $this->searchAllAsync($slug);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Returns the all creator codes matching the given slug.
     *
     * @param string|array|mixed $slug
     * @return null|CreatorCodeArrayTask
     */
    public function searchAllAsync($slug)
    {
        FortniteApiError::clearLastError();

        if (empty($slug)) {
            FortniteApiError::setLastError("Missing paramter 'slug'.");

            return null;
        }

        $path = "/creatorcode/search/all";

        $query = [
            "slug" => $slug
        ];

        $promise = $this->httpClient->getAsync($path, [
            "query" => $query
        ]);

        return new CreatorCodeArrayTask($promise);
    }
}
