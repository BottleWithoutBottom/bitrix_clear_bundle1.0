<?php
use Bitrix\Main\EventManager;

/** Добавляем события в следующием виде: $eventManager->addEventHandler('модуль', 'событие', ['Класс', 'Метод']) */
$eventManager = EventManager::getInstance();

//$eventManager->addEventHandler('main', 'OnPageStart' ,[]);
