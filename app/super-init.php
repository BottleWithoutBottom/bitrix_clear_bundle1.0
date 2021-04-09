<?php
require($_SERVER['DOCUMENT_ROOT'] . '/local/app/constants/paths.php');
require(AJAX_VIRTUAL_PATH);
require(APP_PATH . 'eventHandlers/eventHandlers.php');
require(APP_PATH . 'vendor/autoload.php');

function getContainer()
{
    $containerBuilder = new \DI\ContainerBuilder();
    $containerBuilder->addDefinitions(DI_CONFIG_PATH);
    return $containerBuilder->build();
}