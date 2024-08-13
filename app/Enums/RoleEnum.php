<?php

namespace App\Enums;

enum RoleEnum : string
{
    case SHOP = 'shop';
    case ADMIN = 'admin';

    public function getlocalized(): string
    {
        return match ($this) {
            self::SHOP => 'Продавец',
            self::ADMIN => 'Администратор',
        };
    }
}
