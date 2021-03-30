<?php

namespace App\Router;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
use FastRoute;
use App\Utils\Container;
\Bitrix\Main\Loader::includeModule('letsrock.lib');

/**
 * Чтобы редиректы начали работать
 * RewriteRule ^(.*)ajax-virtual(.*)$ /local/app/Router/bootstrap.php?$1 [QSA,L] - на апаче
 * rewrite ^(.*)ajax-virtual(.*)$ /local/app/Router/bootstrap.php?$1; - на Nginx
 */

/**
 * Router
 */
$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute(['GET'], AJAX_VIRTAL_MY, 'App\Controllers\MyController/show');
});

//___________________________
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$uri = rawurldecode($uri);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $vars['POST'] = $_POST;
        if (empty($vars['POST'])) {
            $postData = file_get_contents('php://input');
            $data = json_decode($postData, true);
            $vars['POST'] = $data;
        }

        list($class, $method) = explode("/", $handler, 2);
        $container = new Container();
        $container->handle([$class, $method], $vars);
        break;
}