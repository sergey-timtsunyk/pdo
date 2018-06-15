<?php
/**
 * User: Serhii T.
 * Date: 6/12/18
 */

namespace App\Validation\Validator;

class IntValidator implements ValidatorInterface
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

        return array_key_exists($name, $data) && \is_int($data[$name]);
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return sprintf('The value "%s" must be integer.', $this->name);
    }
}
