<?php

namespace App\Enums;

use App\Traits\Enum\ArrayableEnum as ArrayableEnumTrait;

enum SexEnum: string
{
    use ArrayableEnumTrait;

    case Female = 'female';
    case Male = 'male';
}
