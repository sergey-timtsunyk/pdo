<?php
/**
 * User: Serhii T.
 * Date: 6/12/18
 */

namespace App\Validation;

use App\Exception\ExceptionValidation;
use App\Validation\Validator\ValidatorInterface;
use App\Validation\Validator\FactoryValidator;

class ValidationHandler implements ValidationHandlerInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $rulers;

    /**
     * @var FactoryValidator
     */
    private $factoryValidator;

    /**
     * ValidationHandler constructor.
     * @param FactoryValidator $factoryValidator
     */
    public function __construct(FactoryValidator $factoryValidator)
    {
        $this->factoryValidator = $factoryValidator;
    }


    /**
     * @param array $data
     * @return ValidationHandler
     */
    public function setData(array $data): ValidationHandlerInterface
    {
        $this->data = $data;

        return $this;
    }

    public function setRulers(array $rulers): ValidationHandlerInterface
    {
        $this->rulers = $rulers;

        return $this;
    }

    /**
     * @throws ExceptionValidation
     * @throws \App\Exception\ExceptionApp
     */
    public function validated()
    {
        $error = [];

        foreach ($this->rulers as $name => $rulers) {
            foreach ($rulers as $ruler) {
                $validator = $this->getValidator($ruler);
                if (!$validator->isValid($this->data, $name)) {
                    $error[$name][] = $validator->getMessage();
                }
            }
        }

        if (!empty($error)) {
            throw new ExceptionValidation($error);
        }
    }

    /**
     * @param string $ruler
     * @return ValidatorInterface
     * @throws \App\Exception\ExceptionApp
     */
    private function getValidator(string $ruler): ValidatorInterface
    {
        return $this->factoryValidator->getValidatorByRuler($ruler);
    }
}
