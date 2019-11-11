<?php

namespace MichelPi\FortniteApi\Components\Objects;

use Exception;
use MichelPi\FortniteApi\Components\Objects\Reflection\Activator;

class NewsMessage
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
    public $image;

    /**
     * Undocumented variable
     *
     * @var bool
     */
    public $hidden;

    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $messageType;

    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $type;

    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $adspace;

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
    public $body;

    /**
     * Undocumented variable
     *
     * @var bool
     */
    public $spotlight;

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
     * @param NewsMessage $obj
     * @param array|mixed $body
     * @return bool
     */
    private static function initializeObject(&$obj, &$body)
    {
        try {
            $obj->image = $body["image"];
            $obj->hidden = $body["hidden"];
            $obj->messageType = $body["messageType"];
            $obj->type = $body["type"];
            $obj->adspace = $body["adspace"];
            $obj->title = $body["title"];
            $obj->body = $body["body"];
            $obj->spotlight = $body["spotlight"];
            
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
                return new NewsMessage();
            }, function (&$obj, &$body) {
                return self::initializeObject($obj, $body);
            });
        }

        return self::$_activator;
    }
}
