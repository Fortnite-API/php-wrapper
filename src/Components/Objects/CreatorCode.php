<?php

namespace FortniteApi\Components\Objects;

use Exception;
use FortniteApi\Components\Objects\Reflection\Activator;

class CreatorCode
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
     * @var string
     */
    public $id;
    /**
     * Undocumented variable
     *
     * @var string
     */
    public $slug;
    
    /**
     * Undocumented variable
     *
     * @var string
     */
    public $displayName;

    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $status;

    /**
     * Undocumented variable
     *
     * @var bool
     */
    public $verified;

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
     * @param CreatorCode $obj
     * @param array|mixed $body
     * @return bool
     */
    private static function initializeObject(&$obj, &$body)
    {
        try {
            $obj->id = $body["id"];
            $obj->slug = $body["slug"];
            $obj->displayName = $body["displayName"];
            $obj->status = $body["status"];
            $obj->verified = $body["verified"];
            
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
                return new CreatorCode();
            }, function (&$obj, &$body) {
                return self::initializeObject($obj, $body);
            });
        }

        return self::$_activator;
    }
}
