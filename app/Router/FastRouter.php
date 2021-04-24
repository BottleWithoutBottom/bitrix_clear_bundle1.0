<?php

namespace App\Router;
use FastRoute;
use FastRoute\RouteCollector;
use App\Utils\Container;
use App\MVC\Controllers\TestController;

class FastRouter extends Router
{
    private const METHOD = 'METHOD';
    private const URL = 'URL';
    private const HANDLER = 'HANDLER';

    public function handle()
    {
        $dispatcher = $this->getDispatcher();
        if ($dispatcher) {
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

                    [$class, $method] = explode("/", $handler, 2);
                    $container = new Container();
                    $container->handle([$class, $method], $vars);
                    break;
            }
        }

        return false;
    }

    private function getDispatcher()
    {
        $routeList = $this->routeList();

        if (!empty($routeList)) {
            return FastRoute\simpleDispatcher(function (RouteCollector $r) use ($routeList) {
                foreach ($routeList as $route) {
                    $r->addRoute(
                        $route[static::METHOD],
                        $route[static::URL],
                        $route[static::HANDLER]
                    );
                }
            });
        }

        return false;
    }

    /**
     * @return array
     */
    public function routeList()
    {
        return [
            [
                static::METHOD => ['GET'],
                static::URL => AJAX_VIRTUAL,
                static::HANDLER => $this->setHandlerString(TestController::class, 'test')
            ]
        ];
    }

    /** @return string */
    private function setHandlerString($className, $methodName)
    {
        if (empty($className) || empty($methodName)) return false;

        return $className . '/' . $methodName;
    }
}