<?php

use FortniteApi\Components\JsonSerializer;
use FortniteApi\FortniteApi;
use FortniteApi\FortniteApiError;

require_once __DIR__ . '/../vendor/autoload.php';

header("Content-Type: application/json");

$api = new FortniteApi(null);

$awaitables = [
    "cosmetic" => $api->cosmetics->getAsync("bannertoken_001_cattus"),
    "cosmeticSearch" => $api->cosmetics->searchAsync(["rarity" => "legendary"]),
    "cosmeticSearchAll" => $api->cosmetics->searchAllAsync(["rarity" => "uncommon"]),
    "cosmetics" => $api->cosmetics->getAllAsync(),
    "news" => $api->news->getAsync(),
    "shop" => $api->shop->getAsync(),
    "creatorCode" => $api->creatorCode->getAsync("getonmylvl"),
    "creatorCodeSearch" => $api->creatorCode->searchAsync("getonmylvl"),
    "creatorCodeSearchAll" => $api->creatorCode->searchAllAsync("getonmylvl"),
];

$result = [];
foreach ($awaitables as $key => $value) {
    $response = $value->await();

    if (empty($response)) {
        $result[$key] = FortniteApiError::getLastError();
    } else {
        $result[$key] = $response;
    }
}

echo JsonSerializer::serialize($result);
