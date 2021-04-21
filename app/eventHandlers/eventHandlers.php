<?php
use Bitrix\Main\EventManager;
use App\Events\IblockEvent;

/** Добавляем события в следующием виде: $eventManager->addEventHandler('модуль', 'событие', ['Класс', 'Метод']) */
$eventManager = EventManager::getInstance();

$eventManager->addEventHandler('iblock', 'OnAfterIBlockAdd' ,[IblockEvent::class, 'createModel']);
