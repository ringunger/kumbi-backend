<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{

    public function getAllUsers(Request $request): Collection|LengthAwarePaginator
    {
        $query = User::query()
            ->with('roles')
            ->with('permissions');

        if ($request->filled('per_page')) {
            return $query->paginate((int) $request->input('per_page'));
        }

        return $query->get();
    }

    public function getUserById(int $id): ?User
    {
        return User::query()
            ->with('roles')
            ->with('permissions')
            ->find($id);
    }

    public function createUser(array $data): User
    {
        $user = User::query()->create($data);

        $user->load('roles', 'permissions');

        if (isset($data['roles']) && is_array($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        if (isset($data['permissions']) && is_array($data['permissions'])) {
            $user->syncPermissions($data['permissions']);
        }

        $user->load('roles', 'permissions');

        return $user;
    }

    public function updateUser(User $user, array $data): User
    {
        $user->fill($data);
        $user->save();

        if (isset($data['roles']) && is_array($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        if (isset($data['permissions']) && is_array($data['permissions'])) {
            $user->syncPermissions($data['permissions']);
        }

        $user->load('roles', 'permissions');

        return $user;
    }

    public function deleteUser(User $user): bool
    {
        return (bool) $user->delete();
    }
}
