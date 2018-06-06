<?php
namespace App\Controller;

use App\Model\District;
use App\Request\Request;

class DistrictController extends Controller
{
    /**
     * @var \App\Store\StoreModels\StoreHandlerInterface
     */
    private $storeHandlerDistrict;

    public function __construct($storeHandlerDistrict)
    {
        $this->storeHandlerDistrict = $storeHandlerDistrict;
    }

    public function getList()
    {
        $text="<table class='new-table'><tr><th>id</th><th>Name</th><th>Population</th><th>Description</th><th>Редакт</th><th>Удалить</th></tr >";
        /** @var District $value */
        foreach ($this->storeHandlerDistrict->collection() as $value) {
            $text.="<tr><td class=\"id\">{$value->getId()}</td><td >{$value->getName()}</td>
                    <td>{$value->getPopulation()}</td><td>{$value->getDescription()}</td><td><button class='edit'>редакт</button></td><td><button class='delete'>удалить</button></td></tr>";
        }

        $text .= "</table>";

        return $text;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getDistrict(Request $request): string
    {
        $id = $request->getVarParameter('id');
        $district = $this->storeHandlerDistrict->findById($id);

        return $this->render(json_encode($district->getArray(), JSON_UNESCAPED_UNICODE));
    }

    public function createDistrict(Request $request): string
    {
        $district = new \App\Model\District;
        $district->setName($request->getRequestParameter('name'));
        $district->setPopulation($request->getRequestParameter('population'));
        $district->setDescription($request->getRequestParameter('description'));
        $this->storeHandlerDistrict->create($district);

        return $district->getId();
    }

    /**
     * @param Request $request
     */
    public function deleteDistrict(Request $request)
    {
        $id = $request->getVarParameter('id');
        $this->storeHandlerDistrict->deleteById($id);
    }

    /**
     * @param Request $request
     */
    public function editDistrict(Request $request)
    {
        $id = $request->getVarParameter('id');
        /** @var District $district */
        $district = $this->storeHandlerDistrict->findById($id);

        $district->setName($request->getRequestParameter('name'));
        $district->setPopulation($request->getRequestParameter('population'));
        $district->setDescription($request->getRequestParameter('description'));
        $this->storeHandlerDistrict->update($district);
    }
}
