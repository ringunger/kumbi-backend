<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserService
{

    public function getAllUsers(Request $request): Collection
    {
        return User::query()
            ->with('roles')
            ->with('permissions')
            ->get();
    }
}
