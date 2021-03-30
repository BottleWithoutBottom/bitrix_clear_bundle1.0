<?php

namespace Letsrock\Lib\Controllers;
use Bitrix\Main\Application;
use Letsrock\Lib\View\View;

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }


    public function getRequest()
    {
        return Application::getInstance()->getContext()->getRequest();
    }

    /**
     * @param string $viewName - название view
     * @param array $params - массив значений, которые будут преобразованы в переменные
     */
    public function render($viewName, $params = [])
    {
        return $this->view->render($viewName, $params = []);
    }
}