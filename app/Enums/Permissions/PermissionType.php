<?php

namespace App\Enums\Permissions;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

class PermissionType extends Enum
{
    const PLAT = 1;
    const INGREDIENT = 2;

    public static function asFullArray()
    {
        $result = [];
        foreach (static::asArray() as $key => $value) {
            $result[] = [
                'value' => $value,
                'label' => static::getDescription($value),
                'key' => static::getKey($value),
            ];
        }
        return $result;
    }
}
