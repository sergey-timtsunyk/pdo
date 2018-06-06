<?php
/**
 * User: Serhii T.
 * Date: 6/5/18
 */

namespace Controller;

use App\Controller\Controller;

class ExceptionController extends Controller
{
    public function index()
    {
        $this->renderLayout('exception');
    }
}
