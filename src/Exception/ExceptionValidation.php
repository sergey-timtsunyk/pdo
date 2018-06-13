<?php
/**
 * User: Serhii T.
 * Date: 6/5/18
 */

namespace App\Exception;

use Throwable;

class ExceptionValidation extends ExceptionApp
{
    /**
     * @var array
     */
    private $error;

    /**
     * ExceptionValidation constructor.
     * @param array $error
     */
    public function __construct(array $error)
    {
        parent::__construct('Validation fail!', 0, null);

        $this->error = $error;
    }

    /**
     * @return array
     */
    public function getError(): array
    {
        return $this->error;
    }
}
