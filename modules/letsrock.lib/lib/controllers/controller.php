<?php

namespace Letsrock\Lib\Controllers;
use Bitrix\Main\Application;

abstract class Controller
{
    public function getRequest()
    {
        return Application::getInstance()->getContext()->getRequest();
    }
}