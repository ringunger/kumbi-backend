<?php

namespace App\Traits;

use App\Models\Scopes\BusinessScope;

trait UnderBusiness
{
    //boot
    protected static function underBusinessBoot()
    {
        static::addGlobalScope(new BusinessScope());
    }
}
