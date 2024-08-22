<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Http\Requests\CreateUserRequest;
use App\Models\Role;
use App\Models\User;

class AuthService
{
    public function createUser($request)
    {
        $request['role_id'] = Role::where('slug', RoleEnum::SHOP->value)->first()->id;;
        return User::create($request);
    }

    public function logoutUser(): void
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
