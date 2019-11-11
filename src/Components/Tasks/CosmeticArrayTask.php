<?php

namespace MichelPi\FortniteApi\Components\Tasks;

use Exception;
use MichelPi\FortniteApi\Components\HttpClient;
use MichelPi\FortniteApi\Components\Objects\Cosmetic;
use MichelPi\FortniteApi\FortniteApiError;
use Psr\Http\Message\ResponseInterface as Response;

class CosmeticArrayTask extends Awaitable
{
    /**
     * Awaits the response and returns the parsed body.
     *
     * @return null|Cosmetic[]|array
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
                return Cosmetic::createObjectArray(null);
            }
            
            $text = (string)$body;

            return Cosmetic::createObjectArray($text);
        } catch (Exception $ex) {
            FortniteApiError::setLastError($ex->getMessage());

            return null;
        }
    }
}
