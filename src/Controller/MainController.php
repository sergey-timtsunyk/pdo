<?php
/**
 * User: Serhii T.
 * Date: 6/2/18
 */

namespace App\Controller;

use App\Request\Request;
use App\Store\StoreModels\StoreHandlerInterface;

class MainController extends Controller
{
    /**
     * @var StoreHandlerInterface
     */
    private $storeHandlerDistrict;

    /**
     * MainController constructor.
     * @param StoreHandlerInterface $storeHandlerDistrict
     */
    public function __construct(StoreHandlerInterface $storeHandlerDistrict)
    {
        $this->storeHandlerDistrict = $storeHandlerDistrict;
    }

    /**
     * @return string
     */
    public function index(Request $request)
    {
        return $this->renderLayout('index', [
            'districts' => $this->storeHandlerDistrict->collection(),
            'title' => 'Hello!',
        ]);
    }
}
