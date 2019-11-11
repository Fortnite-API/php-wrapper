<?php

namespace MichelPi\FortniteApi\Components\Objects;

use Exception;
use MichelPi\FortniteApi\Components\Objects\Reflection\Activator;

class ShopEntry
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
     * @var int
     */
    public $regularPrice;

    /**
     * Undocumented variable
     *
     * @var int
     */
    public $finalPrice;

    /**
     * Undocumented variable
     *
     * @var int
     */
    public $panel;

    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $banner;

    /**
     * Undocumented variable
     *
     * @var null|Cosmetic[]|array
     */
    public $items;

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
     * @param ShopEntry $obj
     * @param array|mixed $body
     * @return bool
     */
    private static function initializeObject(&$obj, &$body)
    {
        try {
            $obj->regularPrice = $body["regularPrice"];
            $obj->finalPrice = $body["finalPrice"];
            $obj->panel = $body["panel"];
            $obj->banner = $body["banner"];
            $obj->items = Cosmetic::createObjectArray($body["items"]);

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
                return new ShopEntry();
            }, function (&$obj, &$body) {
                return self::initializeObject($obj, $body);
            });
        }

        return self::$_activator;
    }
}
