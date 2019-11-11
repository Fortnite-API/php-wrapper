<?php

namespace MichelPi\FortniteApi\Components\Objects;

use Exception;
use MichelPi\FortniteApi\Components\Objects\Reflection\Activator;

class NewsEntry
{
    /**
     * Undocumented variable
     *
     * @var Activator
     */
    private static $_activator;

    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $language;

    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $title;

    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $lastModified;

    /**
     * Undocumented variable
     *
     * @var null|NewsMessage[]|array
     */
    public $messages;

    public static function createObject($body)
    {
        return self::getActivator()->createObjectFromBody($body);
    }

    public static function createObjectArray($body)
    {
        return self::getActivator()->createArrayFromBody($body);
    }

    /**
     * Undocumented function
     *
     * @param NewsEntry $obj
     * @param array|mixed $body
     * @return bool
     */
    private static function initializeObject(&$obj, &$body)
    {
        try {
            $obj->language = $body["language"];
            $obj->title = $body["title"];
            $obj->lastModified = $body["lastModified"];
            $obj->messages = NewsMessage::createObjectArray($body["messages"]);
            
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Undocumented function
     *
     * @return Activator
     */
    private static function getActivator()
    {
        if (empty(self::$_activator)) {
            self::$_activator = new Activator(function () {
                return new NewsEntry();
            }, function (&$obj, &$body) {
                return self::initializeObject($obj, $body);
            });
        }

        return self::$_activator;
    }
}
