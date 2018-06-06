<?php
/**
 * User: Serhii T.
 * Date: 6/5/18
 */

namespace App\Model;

trait TraitModelGetArrayToProperties
{

    /**
     * @return array
     */
    public function getArray(): array
    {
        $arr = [];
        foreach (get_object_vars($this) as $property => $var) {
            $arr[$property] = $var;
        }

        return $arr;
    }
}
