<?php

namespace MichelPi\FortniteApi;

use Exception;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Provides access to errors returned by API's.
 */
class FortniteApiError
{
    private static $_lastError;

    /**
     * Returns the HTTP status code returned for a request or 0.
     *
     * @var int
     */
    public $statusCode;
    /**
     * Returns the reason phrase of the returned status code or empty.
     *
     * @var string
     */
    public $reasonPhrase;
    /**
     * Returns the request body if it exists or the exception message returned by the response.
     *
     * @var string
     */
    public $body;
    /**
     * Returns the message set by the api who returned an error.
     *
     * @var string
     */
    public $message;

    /**
     * Initializes a new FortniteApiError object.
     *
     * @param null|string $message
     * @param null|Response $response
     */
    public function __construct($message = null, $response = null)
    {
        if ($message == null) {
            $this->message = '';
        } else {
            $this->message = $message;
        }
        
        if (empty($response)) {
            $this->statusCode = 0;
            $this->reasonPhrase = '';
            $this->body = '';
        } else {
            try {
                $this->statusCode = $response->getStatusCode();
                $this->reasonPhrase = $response->getReasonPhrase();

                $this->body = (string)$response->getBody();
            } catch (Exception $ex) {
                $this->body = $ex->getMessage();
            }
        }
    }

    /**
     * Determines whether an error occured within the last called function.
     *
     * @return boolean
     */
    public static function hasLastError()
    {
        return !empty(self::$_lastError);
    }

    /**
     * @internal
     * @ignore
     *
     * @return void
     */
    public static function clearLastError()
    {
        self::$_lastError = null;
    }

    /**
     * Returns the error set by the last request or false if none is set.
     *
     * @return bool|FortniteApiError
     */
    public static function getLastError()
    {
        if (empty(self::$_lastError)) {
            return false;
        } else {
            return self::$_lastError;
        }
    }

    /**
     * @internal
     * @ignore
     *
     * @param null|string $message
     * @param null|Response $response
     * @return void
     */
    public static function setLastError($message = null, $response = null)
    {
        self::$_lastError = new FortniteApiError($message, $response);
    }
}
