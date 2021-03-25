<?php
require($_SERVER['DOCUMENT_ROOT'] . '/local/constants/paths.php');
require(AJAX_VIRTUAL_PATH);
require(LOCAL_PATH . 'vendor/autoload.php');
use Bitrix\Main\Loader;
Loader::includeModule('letsrock.lib');