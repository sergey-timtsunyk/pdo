<?php

use App\Exception\ExceptionApp;
use App\Request\RequestHandler;

require_once 'vendor/autoload.php';

$host = '127.0.0.1';
$dbName = 'test_db';
$user = 'root';
$pass = '123';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
    \App\Store\FactoryStore::init($dbh);

    $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);

    $controllerCollection = [
        'MainController' => new \App\Controller\MainController($storeHandlerDistrict),
        'DistrictController' => new \App\Controller\DistrictController($storeHandlerDistrict),
    ];

    $request = RequestHandler::initRequest();

    if (!array_key_exists($request->getHandler(), $controllerCollection)) {
        throw new \App\Exception\ExceptionController(
            sprintf('Not fount class controller: %s.', $request->getHandler())
        );
    }

    $controller = $controllerCollection[$request->getHandler()];

    if (!method_exists($controller, $request->getMethod())) {
        throw new \App\Exception\ExceptionController(
            sprintf('Not fount method [%s] in class: %s.', $request->getMethod(), $request->getHandler())
        );
    }
 
    $method = $request->getMethod();
    $controller->$method($request);


} catch (PDOException $exception) {
    echo $exception->getMessage();
} catch (ExceptionApp $exception) {
    echo $exception->getMessage();
} catch (PDOException $exception) {
    echo $exception->getMessage();
} catch (Throwable $e) {
    echo $e->getMessage();
}


