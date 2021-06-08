<?php

namespace App\MVC\Models;
use \CMain;
\Bitrix\Main\Loader::includeModule('main');


class Server extends Model
{
    private $prodServerName = 'домен продакшена';
    private $devServerName = 'домен тестового';
    private static $instance;

    private function __construct()
    {}

    public function isProduction()
    {
        return $_SERVER['HTTP_HOST'] == $this->prodServerName;
    }

    public function isDev()
    {
        return $_SERVER['HTTP_HOST'] == $this->devServerName;
    }

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getFullServerName()
    {
        return CMain::IsHTTPS() ? "https://" : "http://" . $_SERVER['SERVER_NAME'];

    }
}