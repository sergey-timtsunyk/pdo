<?php
namespace App\Controller;

use App\Model\District;
use App\Store\StoreModels\StoreHandlerInterface;

class DistrictController
{
    public function getList()
    {
        $storeHandlerDistrict = \App\Store\FactoryStore::getStoreHandlerByClassModel(\App\Model\District::class);

        $text="<table class='new-table'><tr><th>id</th><th>Name</th><th>Population</th><th>Description</th><th>Редакт</th><th>Удалить</th></tr >";
        /** @var District $value */
        foreach ($storeHandlerDistrict->collection() as $value){
            $text.="<tr><td class=\"id\">{$value->getId()}</td><td >{$value->getName()}</td>
                    <td>{$value->getPopulation()}</td><td>{$value->getDescription()}</td><td><button class='edit'>редакт</button></td><td><button class='delete'>удалить</button></td></tr>";
        }

        $text .= "</table>";

        return $text;
    }
}
