<?php

use Bitrix\Main\EventManager;
use WS\Handlers\Catalog\Price;
use WS\Tools\Events\EventType;
use WS\Tools\Module;

$module = Module::getInstance();
$eventManager = $module->eventManager();
$bitrixEventManager = EventManager::getInstance();

// price update
$eventType = EventType::create(EventType::CATALOG_PRICE_UPDATE);
$eventManager->subscribe($eventType, array(Price::className(), 'priceUpdateHandler'));

$eventType = EventType::create(EventType::CATALOG_PRICE_ADD);
$eventManager->subscribe($eventType, array(Price::className(), 'priceUpdateHandler'));