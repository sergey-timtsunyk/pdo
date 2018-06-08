<?php
/**
 * User: Serhii T.
 * Date: 6/8/18
 */

namespace App\Validation;

interface ValidationHandlerInterface
{
    public function setData(array $parameters): self;
    public function setRulers(array $parameters): self;
    public function validated();
}
