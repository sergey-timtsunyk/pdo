<?php

use App\Controller\DistrictController;
use App\Route\RouteHandler;

require_once 'vendor/autoload.php';

$host = '127.0.0.1';
$dbName = 'hillel';
$user = 'root';
$pass = '';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
    \App\Store\FactoryStore::init($dbh);
    $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);

    $routCollection = [
        'DistrictController::getList' => new DistrictController($storeHandlerDistrict),
    ];

    $controllerName = RouteHandler::init();


/*    var_dump($_SERVER['PATH_INFO']);
    var_dump($_SERVER['REQUEST_METHOD']);
    var_dump($_SERVER['QUERY_STRING']);*/



    if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['PATH_INFO'] === '/districts'){

        $controller = new DistrictController();

        echo $controller->getList();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['PATH_INFO'] === '/districts') {

        if (empty($_POST['district']) && empty($_POST['name']) && empty($_POST['population']) && empty($_POST['description'])) {
            throw new \Exception('Empty data!');
        }

        $newDistrict = new \App\Model\District;
        $newDistrict->setName($_POST['name']);
        $newDistrict->setPopulation($_POST['population']);
        $newDistrict->setDescription($_POST['description']);
        $storeHandlerDistrict->create($newDistrict);
    }

    if (!empty($_POST['delete']) && $_POST['delete'] === 'ok' && !empty($_POST['id'] || $_POST['id'] === '0')) {
        $storeHandlerDistrict->deleteById($_POST['id']);

    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && false !== strpos($_SERVER['PATH_INFO'], '/districts/')) {

        $path = $_SERVER['PATH_INFO'];
        $id = (int)str_replace( '/districts/', '', $path);

        $editDistrict = $storeHandlerDistrict->findById($id);

        echo $editDistrict->getName().";".$editDistrict->getPopulation().";".$editDistrict->getDescription();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && false !== strpos($_SERVER['PATH_INFO'], '/districts/')) {

        $path = $_SERVER['PATH_INFO'];
        $id = (int)str_replace( '/districts/', '', $path);

        $editDistrict = $storeHandlerDistrict->findById($id);
        $editDistrict->setName($_POST['name']);
        $editDistrict->setPopulation($_POST['population']);
        $editDistrict->setDescription($_POST['description']);
        $storeHandlerDistrict->update($editDistrict);
    }


} catch (PDOException $exception) {
    echo $exception->getMessage();
} catch (Exception $e) {
}


