<?php

namespace App\Enums;

enum UnitEnum : string
{
    case THING = 'thing';
    case PACKAGE = 'package';

    public function getlocalized(): string
    {
        return match ($this) {
            self::THING => 'Штука',
            self::PACKAGE => 'Упаковка',
        };
    }
}
