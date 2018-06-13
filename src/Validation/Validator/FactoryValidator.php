<?php
/**
 * User: Serhii T.
 * Date: 6/12/18
 */

namespace App\Validation\Validator;

use App\Exception\ExceptionApp;

class FactoryValidator
{
    /**
     * @var \ArrayObject
     */
    private $validators;

    public function __construct()
    {
        $this->validators = new \ArrayObject();
    }

    /**
     * @param string $ruler
     * @return ValidatorInterface
     * @throws ExceptionApp
     */
    public function getValidatorByRuler(string $ruler): ValidatorInterface
    {
        if (!$this->validators->offsetExists($ruler)) {
            $this->validators->offsetSet($ruler, $this->createValidator($ruler));
        }

        return $this->validators->offsetGet($ruler);
    }

    /**
     * @param string $ruler
     * @return ValidatorInterface
     * @throws ExceptionApp
     */
    private function createValidator(string $ruler): ValidatorInterface
    {
        $className = sprintf('%s\%sValidator', __NAMESPACE__, ucfirst($ruler));

        if (!class_exists($className)) {
            throw new ExceptionApp(sprintf('Not found class: "%s"', $className));
        }

        if (!\in_array(ValidatorInterface::class, class_implements($className), true)) {
            throw new ExceptionApp(
                sprintf('Class "%s" not implement interface "%s"', $className, ValidatorInterface::class)
            );
        }

        return new $className;
    }
}
