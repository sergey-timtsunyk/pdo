<?php
/**
 * User: Serhii T.
 * Date: 6/12/18
 */

namespace App\Validation\Validator;

class RequiredValidator implements ValidatorInterface
{
    private $name;

    /**
     * @param array $data
     * @param string $name
     * @return bool
     */
    public function isValid(array $data, string $name): bool
    {
        $this->name = $name;

        return array_key_exists($name, $data) ? !empty($data[$name]) : false;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return sprintf('The value "%s" is required.', $this->name);
    }
}
