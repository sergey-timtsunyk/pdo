<?php
/**
 * User: Serhii T.
 * Date: 6/12/18
 */

namespace App\Validation\Validator;

interface ValidatorInterface
{
    public function isValid(array $data, string $name): bool;
    public function getMessage(): string;
}
