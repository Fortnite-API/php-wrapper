<?php

namespace MichelPi\FortniteApi\Components\Objects;

use Exception;
use MichelPi\FortniteApi\Components\Objects\Reflection\Activator;

class Shop
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
    public $hash;

    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $date;

    /**
     * Undocumented variable
     *
     * @var null|ShopEntry[]|array
     */
    public $featured;

    /**
     * Undocumented variable
     *
     * @var null|ShopEntry[]|array
     */
    public $daily;

    /**
     * Undocumented variable
     *
     * @var null|ShopEntry[]|array
     */
    public $votes;

    /**
     * Undocumented variable
     *
     * @var null|ShopEntry[]|array
     */
    public $voteWinners;

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
     * @param Shop $obj
     * @param array|mixed $body
     * @return bool
     */
    private static function initializeObject(&$obj, &$body)
    {
        try {
            $obj->hash = $body["hash"];
            $obj->date = $body["date"];
            $obj->featured = ShopEntry::createObjectArray($body["featured"]);
            $obj->daily = ShopEntry::createObjectArray($body["daily"]);
            $obj->votes = ShopEntry::createObjectArray($body["votes"]);
            $obj->voteWinners = ShopEntry::createObjectArray($body["voteWinners"]);

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
                return new Shop();
            }, function (&$obj, &$body) {
                return self::initializeObject($obj, $body);
            });
        }

        return self::$_activator;
    }
}
