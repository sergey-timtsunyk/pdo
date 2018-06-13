<?php
/**
 * User: Serhii T.
 * Date: 6/8/18
 */

namespace App\Validation;

use App\Exception\ExceptionValidation;

interface ValidationHandlerInterface
{
    public function setData(array $data): self;
    public function setRulers(array $rulers): self;
    public function validated();
}
