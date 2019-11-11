<?php

namespace MichelPi\FortniteApi\Components\Objects\Reflection;

use MichelPi\FortniteApi\Components\JsonSerializer;

class Activator
{
    private $activator;
    private $initializer;

    public function __construct($activator, $initializer)
    {
        $this->activator = $activator;
        $this->initializer = $initializer;
    }

    public function createObjectFromBody($body)
    {
        if (empty($body)) {
            return null;
        }

        if (is_string($body)) {
            $body = JsonSerializer::deserialize($body);

            if ($body === false) {
                return null;
            }
        }

        if (array_key_exists("status", $body) && array_key_exists("data", $body)) {
            $body = $body["data"];
        }

        $obj = call_user_func($this->activator);

        if (call_user_func_array($this->initializer, array(&$obj, &$body))) {
            return $obj;
        } else {
            return null;
        }
    }

    public function createArrayFromBody($body)
    {
        if (empty($body)) {
            return null;
        }

        if (is_string($body)) {
            $body = JsonSerializer::deserialize($body);

            if ($body === false) {
                return null;
            }
        }

        if (array_key_exists("status", $body) && array_key_exists("data", $body)) {
            $body = $body["data"];
        }

        $result = [];

        foreach ($body as $item) {
            $obj = call_user_func($this->activator);

            if (call_user_func_array($this->initializer, array(&$obj, &$item))) {
                $result[] = $obj;
            }
        }

        if (count($result) == 0) {
            return null;
        } else {
            return $result;
        }
    }
}
