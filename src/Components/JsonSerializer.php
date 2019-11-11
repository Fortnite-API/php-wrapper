<?php

namespace MichelPi\FortniteApi\Components;

class JsonSerializer
{
    public static function serialize($value)
    {
        return json_encode($value, JSON_FORCE_OBJECT);
    }

    public static function deserialize($value)
    {
        if (empty($value)) {
            return false;
        }
        
        $obj = json_decode($value, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $obj;
        } else {
            return false;
        }
    }
}
