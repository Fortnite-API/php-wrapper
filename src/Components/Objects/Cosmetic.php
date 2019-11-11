<?php

namespace MichelPi\FortniteApi\Components\Objects;

use Exception;
use MichelPi\FortniteApi\Components\Objects\Reflection\Activator;

class Cosmetic
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
    public $id;
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
    public $backendType;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $rarity;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $backendRarity;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $name;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $shortDescription;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $description;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $set;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $series;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $backendSeries;
    /**
     * Undocumented variable
     *
     * @var null|Image[]|array
     */
    public $images;
    /**
     * Undocumented variable
     *
     * @var null|Variant[]|array
     */
    public $variants;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $gameplayTags;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $displayAssetPath;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $definition;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $requiredItemId;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $builtInEmoteId;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $path;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $lastUpdate;
    /**
     * Undocumented variable
     *
     * @var null|string
     */
    public $added;

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
     * @param Cosmetic $obj
     * @param array|mixed $body
     * @return bool
     */
    private static function initializeObject(&$obj, &$body)
    {
        try {
            $obj->id = $body["id"];
            $obj->type = $body["type"];
            $obj->backendType = $body["backendType"];
            $obj->rarity = $body["rarity"];
            $obj->backendRarity = $body["backendRarity"];
            $obj->name = $body["name"];
            $obj->shortDescription = $body["shortDescription"];
            $obj->description = $body["description"];
            $obj->set = $body["set"];
            $obj->series = $body["series"];
            $obj->backendSeries = $body["backendSeries"];
            $obj->variants = Variant::createObjectArray($body["variants"]);
            $obj->gameplayTags = $body["gameplayTags"];
            $obj->displayAssetPath = $body["displayAssetPath"];
            $obj->definition = $body["definition"];
            $obj->requiredItemId = $body["requiredItemId"];
            $obj->builtInEmoteId = $body["builtInEmoteId"];
            $obj->path = $body["path"];
            $obj->lastUpdate = $body["lastUpdate"];
            $obj->added = $body["added"];

            $obj->images = [];
            foreach ($body["images"] as $key => $value) {
                $obj->images[$key] = Image::createObject($value);
            }
            
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
                return new Cosmetic();
            }, function (&$obj, &$body) {
                return self::initializeObject($obj, $body);
            });
        }

        return self::$_activator;
    }
}
