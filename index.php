<?php
require_once ('autoload.php');

$host = '127.0.0.1';
$dbName = 'test_db';
$user = 'root';
$pass = '123';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);


    $storeHandlerDistrict = new \App\Store\StoreModels\StoreHandlerDistrict($dbh);

    $district = $storeHandlerDistrict->findById(13);

    $district->setName('13 РАЙОН');

    $storeHandlerDistrict->update($district);

    //@TODO Созданее нового
/*    $district = new \App\Model\District();
    $district->setName('Новый Район1');
    $district->setPopulation(123000);


    $storeHandlerDistrict->create($district);*/


    var_dump($district);

    //@TODO Выборка
/*    $population = '300000';
    $sdh = $dbh->prepare('SELECT * FROM districts d WHERE d.population > :population');
    $sdh->bindParam(':population', $population);
    $sdh->execute();

    foreach ($sdh->fetchAll(PDO::FETCH_CLASS, \App\Model\District::class) as $row) {
        var_dump($row);
    }*/

} catch (PDOException $exception) {
    echo $exception->getMessage();
}

