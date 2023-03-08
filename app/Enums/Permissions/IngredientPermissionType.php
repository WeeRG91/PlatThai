<?php

namespace App\Enums\Permissions;

use App\Enums\Traits\EnumTrait;
use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

class IngredientPermissionType extends Enum
{
    use EnumTrait;
   const MANAGE_INGREDIENT = 'ingredient manage';
   const EDIT_INGREDIENT = 'ingredient edit';
   const CREATE_INGREDIENT = 'ingredient create';
   const DELETE_INGREDIENT = 'ingredient delete';


}
