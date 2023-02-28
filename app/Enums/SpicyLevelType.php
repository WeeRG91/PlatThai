<?php

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

class SpicyLevelType extends Enum
{
    #[Description('Pas épicé du tout !')]
    const LEVEL_1 = 1;
    #[Description('Très légèrement épicé')]
    const LEVEL_2 = 2;
    #[Description('Relevé mais pas trop !')]
    const LEVEL_3 = 3;
    #[Description('Attention, ça pique !')]
    const LEVEL_4 = 4;
    #[Description('Epicé comme en Thaïlande !!!!')]
    const LEVEL_5 = 5;

    public static function getIcons(int $level) :string
    {
        $str = '';
        for($i = 1; $i <= $level; $i++) {
            $str .= '<i class="fa-solid fa-pepper-hot '.static::getCssClass($level) .'"></i>';
        }
        return $str;
    }

    public static function getCssClass(int $level)
    {
        switch ($level) {
            case static::LEVEL_1:
                return 'text-success';
            case static::LEVEL_2:
                return 'text-warning';
            case static::LEVEL_3:
                return 'text-light-orange';
            case static::LEVEL_4:
                return 'text-orange';
            case static::LEVEL_5:
                return 'text-danger';
        }
    }

    public static function asReactSelectArray()
    {
        $result = [];
        foreach (static::asArray() as $key => $value) {
            $result[] = [
                'value' => $value,
                'label' => static::getIcons($value) . ' <span class="ms-2">' . static::getDescription($value) .'</span>'
            ];
        }
        return $result;
    }
}
