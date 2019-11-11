<?php

namespace MichelPi\FortniteApi\Components\Tasks;

use Exception;
use MichelPi\FortniteApi\Components\HttpClient;
use MichelPi\FortniteApi\Components\Objects\NewsEntry;
use MichelPi\FortniteApi\FortniteApiError;
use Psr\Http\Message\ResponseInterface as Response;

class NewsEntryTask extends Awaitable
{
    /**
     * Awaits the response and returns the parsed body.
     *
     * @return null|NewsEntry
     */
    public function await()
    {
        FortniteApiError::clearLastError();

        try {
            /** @var Response $response */
            $response = parent::await();

            if (empty($response)) {
                return null;
            }

            $statusCode = $response->getStatusCode();

            if (!HttpClient::isSuccess($statusCode)) {
                FortniteApiError::setLastError("Request failed.", $response);

                return null;
            }
            
            $body = $response->getBody();

            if (empty($body)) {
                return NewsEntry::createObject(null);
            }
            
            $text = (string)$body;

            return NewsEntry::createObject($text);
        } catch (Exception $ex) {
            FortniteApiError::setLastError($ex->getMessage());

            return null;
        }
    }
}
