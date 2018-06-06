<?php
/**
 * User: Serhii T.
 * Date: 5/29/18
 */

namespace App\Model;

interface ModelInterface extends ModelGetArrayToPropertiesInterface
{
    public function getId(): int;
}
