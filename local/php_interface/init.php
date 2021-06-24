<?php
use Bitrix\Main\Loader;

Loader::includeModule('ws.projectsettings');

$initToolsModule = function () {
    if (!Loader::includeModule("ws.tools")) {
    return;
    }
    $module = \WS\Tools\Module::getInstance();
    $module->config(include __DIR__ . DIRECTORY_SEPARATOR . ".ws_tools_config.php");
    $module->config(include __DIR__ . DIRECTORY_SEPARATOR . "/config.php");
    require(__DIR__."/include/constants.php");
    require(__DIR__."/include/eventHandlers.php");
};
$initToolsModule();