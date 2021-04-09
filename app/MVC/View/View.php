<?php

namespace App\MVC\View;

class View
{
    /**
     * @param string $viewName - название view
     * @param array $params - массив значений, которые будут преобразованы в переменные
     */
    public function render($viewName, $params = [])
    {
        if (empty($viewName)) return false;
        if (!empty($params)) extract($params);
        ob_start();
        require(VIEWS_PATH . $viewName);
        return ob_get_clean();
    }
}