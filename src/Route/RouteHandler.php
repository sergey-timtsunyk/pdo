<?php
/**
 * User: Serhii T.
 * Date: 6/1/18
 */

namespace App\Route;

class RouteHandler
{
    public static  function init()
    {
        $dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/districts', 'DistrictController::getList');
            // {id} must be a number (\d+)
            $r->addRoute('GET', '/districts/{id:\d+}', 'DistrictController::get');
            // The /{title} suffix is optional
            $r->addRoute('POST', '/districts', 'DistrictController::getPost');
        });

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        //var_dump($routeInfo);
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case \FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                // ... call $handler with $vars
                break;
        }

        return $handler;
    }
}
