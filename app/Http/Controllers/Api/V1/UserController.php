<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function index(Request $request)
    {
        $users = $this->userService->getAllUsers($request);
        return $this->apiResponse(UserResource::collection($users));
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = $this->userService->createUser($validated);

        return $this->apiResponse(new UserResource($user), 201);
    }

    public function show(int $id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return $this->apiResponse(['message' => 'User not found'], 404);
        }

        return $this->apiResponse(new UserResource($user));
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return $this->apiResponse(['message' => 'User not found'], 404);
        }

        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user = $this->userService->updateUser($user, $validated);

        return $this->apiResponse(new UserResource($user));
    }

    public function destroy(int $id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return $this->apiResponse(['message' => 'User not found'], 404);
        }

        $this->userService->deleteUser($user);

        return $this->apiResponse(['message' => 'User deleted']);
    }

}
