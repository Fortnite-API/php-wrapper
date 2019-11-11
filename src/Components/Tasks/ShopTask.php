<?php

namespace MichelPi\FortniteApi\Components\Tasks;

use Exception;
use MichelPi\FortniteApi\Components\HttpClient;
use MichelPi\FortniteApi\Components\Objects\Shop;
use MichelPi\FortniteApi\FortniteApiError;
use Psr\Http\Message\ResponseInterface as Response;

class ShopTask extends Awaitable
{
    /**
     * Awaits the response and returns the parsed body.
     *
     * @return null|Shop
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
                return Shop::createObject(null);
            }
            
            $text = (string)$body;

            return Shop::createObject($text);
        } catch (Exception $ex) {
            FortniteApiError::setLastError($ex->getMessage());

            return null;
        }
    }
}
