<?php

namespace FortniteApi\Components\Endpoints;

use FortniteApi\Components\Tasks\NewsEntryTask;
use FortniteApi\Components\Tasks\NewsTask;
use FortniteApi\FortniteApi;
use FortniteApi\FortniteApiError;

use GuzzleHttp\Client;

/**
 * Provides access to the /news/ endpoint.
 */
class NewsEndpoint
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
     * Returns the data of the current battle royale, save the world and creative news.
     *
     * @param null|string $language
     * @return null|News
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
     * Makes an async request for the data of the current battle royale, save the world and creative news.
     *
     * @param null|string $language
     * @return null|NewsTask
     */
    public function getAsync($language = null)
    {
        FortniteApiError::clearLastError();

        $path = "/news";

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

        return new NewsTask($promise);
    }

    /**
     * Returns the current battle royale news.
     *
     * @param null|string $language
     * @return null|NewsEntry
     */
    public function getBr($language = null)
    {
        $promise = $this->getBrAsync($language);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Makes an async tequest for the current battle royale news.
     *
     * @param null|string $language
     * @return null|NewsEntry
     */
    public function getBrAsync($language = null)
    {
        return $this->internalGetAsync("/br", $language);
    }

    /**
     * Returns the current save the world news.
     *
     * @param null|string $language
     * @return null|NewsEntry
     */
    public function getStw($language = null)
    {
        $promise = $this->getStwAsync($language);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Makes an async tequest for the current save the world news.
     *
     * @param null|string $language
     * @return null|NewsEntry
     */
    public function getStwAsync($language = null)
    {
        return $this->internalGetAsync("/stw", $language);
    }

    /**
     * Returns the current creative news.
     *
     * @param null|string $language
     * @return null|NewsEntry
     */
    public function getCreative($language = null)
    {
        $promise = $this->getCreativeAsync($language);

        if ($promise == null) {
            return null;
        } else {
            return $promise->await();
        }
    }

    /**
     * Makes an async tequest for the current creative news.
     *
     * @param null|string $language
     * @return null|NewsEntry
     */
    public function getCreativeAsync($language = null)
    {
        return $this->internalGetAsync("/creative", $language);
    }

    private function internalGetAsync($section, $language = null)
    {
        FortniteApiError::clearLastError();

        $path = "/news".$section;

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

        return new NewsEntryTask($promise);
    }
}
