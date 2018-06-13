<?php
/**
 * User: Serhii T.
 * Date: 6/12/18
 */

namespace App\Test\Validation\Validator;

use App\Validation\Validator\IntValidator;
use PHPUnit\Framework\TestCase;

class IntValidatorTest extends TestCase
{
    /**
     * @test
     */
    public function isValid()
    {
        $validator = new IntValidator();

        $this->assertFalse($validator->isValid(['test' => 'test'], 'test'));
        $this->assertTrue($validator->isValid(['test' => 1], 'test'));
    }

    /**
     * @test
     */
    public function getMessage()
    {
        $validator = new IntValidator();
        $validator->isValid(['test' => 'test'], 'test');

        $this->assertEquals('The value "test" must be integer.', $validator->getMessage());
    }
}
