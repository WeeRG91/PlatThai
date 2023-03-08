<?php

namespace App\Enums\Permissions;

use App\Enums\Traits\EnumTrait;
use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

class PlatPermissionType extends Enum
{
    use EnumTrait;
   const MANAGE_PLAT = 'plat manage';
   const EDIT_PLAT = 'plat edit';
   const CREATE_PLAT = 'plat create';
   const DELETE_PLAT = 'plat delete';


}
