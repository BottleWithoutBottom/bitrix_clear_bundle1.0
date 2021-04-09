<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
?>

<!doctype html>
<html lang="ru">
<head>
    <?
    CUtil::InitJSCore();
    CJSCore::Init(['fx', 'ajax', 'json', 'ls', 'session', 'jquery', 'popup', 'pull']);
    global $APPLICATION;
    ?>
    <? $APPLICATION->ShowHead(); ?>
    <meta charset="UTF-8">
    <title><?= $APPLICATION->ShowTitle(); ?></title>
</head>
<body>
<?$APPLICATION->ShowPanel();?>
