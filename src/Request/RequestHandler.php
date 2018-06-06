<?php
/**
 * User: Serhii T.
 * Date: 6/1/18
 */

namespace App\Request;

class RequestHandler
{
    /**
     * @return Request
     */
    public static  function initRequest(): Request
    {
        $dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', 'MainController::index');
            $r->addRoute('GET', '/districts', 'DistrictController::getList');
            // {id} must be a number (\d+)
            $r->addRoute('GET', '/districts/{id:\d+}', 'DistrictController::getDistrict');
            $r->addRoute('POST', '/districts/{id:\d+}', 'DistrictController::editDistrict');
            $r->addRoute('DELETE', '/districts/{id:\d+}', 'DistrictController::deleteDistrict');
            // The /{title} suffix is optional
            $r->addRoute('POST', '/districts', 'DistrictController::createDistrict');
        });

        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uriRequest = $_SERVER['REQUEST_URI'];


        $uri = rawurldecode(parse_url($uriRequest, PHP_URL_PATH));
        parse_str(rawurldecode(parse_url($uriRequest, PHP_URL_QUERY)), $query);
        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);

        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                break;
            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case \FastRoute\Dispatcher::FOUND:
                [$handler, $method] = self::parserHandler($routeInfo[1]);
                $vars = $routeInfo[2];

                return new Request($handler, $method, $vars, $query, $_POST);
        }
    }

    /**
     * @param $routeHandler
     * @return array
     */
    private static function parserHandler($routeHandler): array
    {
        return explode('::', $routeHandler);
    }
}
