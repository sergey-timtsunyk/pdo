<?php

use App\Exception\ExceptionApp;
use App\Exception\ExceptionValidation;
use App\Request\RequestHandler;
use App\Validation\ValidationHandler;
use App\Validation\Validator\FactoryValidator;

require_once 'vendor/autoload.php';

$host = '127.0.0.1';
$dbName = 'test_db';
$user = 'root';
$pass = '123';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
    \App\Store\FactoryStore::init($dbh);

    $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);

    $validationHandler = new ValidationHandler(new FactoryValidator());

    $controllerCollection = [
        'MainController' => new \App\Controller\MainController($storeHandlerDistrict),
        'DistrictController' => new \App\Controller\DistrictController($storeHandlerDistrict, $validationHandler),
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

} catch (ExceptionValidation $e) {
    $status = sprintf('%s %s', $_SERVER['SERVER_PROTOCOL'], '404 validation error');
    header($status, true, 404);
    echo json_encode($e->getError());
} catch (ExceptionApp $e) {
    \App\Controller\Controller::renderError($e->getMessage());
} catch (Throwable $t) {
    echo $t;
  //  \App\Controller\Controller::renderError($t->getMessage(), 400);
}


