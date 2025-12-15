<?php

namespace App\Enums;

enum RolesEnum: string
{

    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case USER = 'user';


    public function label(): string
    {
        return match ($this) {
            static::SUPER_ADMIN => 'Super Admin',
            static::ADMIN => 'Admin',
            static::USER => 'User',
        };
    }

}
