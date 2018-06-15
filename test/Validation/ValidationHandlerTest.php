<?php
namespace App\Test\Validation;

use App\Exception\ExceptionValidation;
use App\Validation\ValidationHandler;
use App\Validation\Validator\FactoryValidator;
use App\Validation\Validator\ValidatorInterface;

/**
 * User: Serhii T.
 * Date: 6/15/18
 */

class ValidationHandlerTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ValidationHandler
     */
    private $validationHandler;

    /**
     * @var FactoryValidator
     */
    private $factoryValidator;

    /**
     *
     */
    protected function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {

        $this->factoryValidator =  $this->createMock(FactoryValidator::class);
        $this->validationHandler = new ValidationHandler($this->factoryValidator);
        //$this->validationHandler = new ValidationHandler(new FactoryValidator());
    }

    /**
     * @test
     */
    public function validatedSuccses()
    {
        $data = ['test' => 123];

        $validator = $this->createMock(ValidatorInterface::class);
        $validator->expects($this->exactly(2))
            ->method('isValid')
            ->with($data, 'test')
            ->willReturn(true);

        $this->factoryValidator->expects($this->at(0))
            ->method('getValidatorByRuler')
            ->with('int')
            ->willReturn($validator);

        $this->factoryValidator->expects($this->at(1))
            ->method('getValidatorByRuler')
            ->with('required')
            ->willReturn($validator);

        $this->validationHandler->setRulers(['test' => ['int', 'required']])
            ->setData($data);

        $this->validationHandler->validated();
    }

    /**
     * @test
     */
    public function validatedException()
    {
        $data = ['test' => 123];

        $validator = $this->createMock(ValidatorInterface::class);
        $validator->expects($this->exactly(2))
            ->method('isValid')
            ->with($data, 'test')
            ->willReturn(false);

        $validator->expects($this->exactly(2))
            ->method('getMessage')
            ->will($this->onConsecutiveCalls(
                'Exception 1!',
                'Exception 2!'
            ));

        $this->factoryValidator->expects($this->at(0))
            ->method('getValidatorByRuler')
            ->with('int')
            ->willReturn($validator);

        $this->factoryValidator->expects($this->at(1))
            ->method('getValidatorByRuler')
            ->with('required')
            ->willReturn($validator);

        $this->validationHandler->setRulers(['test' => ['int', 'required']])
            ->setData($data);

        try {
            $this->validationHandler->validated();
        } catch (ExceptionValidation $exception) {
            $this->assertEquals(['test' =>['Exception 1!', 'Exception 2!']], $exception->getError());
        }

    }
}
