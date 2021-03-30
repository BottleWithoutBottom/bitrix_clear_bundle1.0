<?php

namespace App\Controllers;
use Bitrix\Main\Application;
use App\View\View;
use App\Models\Vendor\JSONModel;
use App\Models\Vendor\Response;

abstract class Controller
{
    protected $view;
    protected $response;

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

    public function refreshResponse()
    {
        $this->response = new JSONModel();
        return true;
    }

    public function getResponse(): Response
    {
        if (empty($this->response)) $this->refreshResponse();
        return $this->response;
    }
}