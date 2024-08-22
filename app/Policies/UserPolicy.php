<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $authentificatedUser) : Response
    {
        $adminRole = Role::where('slug', RoleEnum::ADMIN->value)->first()->id;
        if ($authentificatedUser->role_id == $adminRole) {
            return Response::allow();
        }
        return Response::deny('У вас нет прав на просмотр данной страницы');
    }

    public function view(User $authentificatedUser, User $user) : Response
    {
        $adminRole = Role::where('slug', RoleEnum::ADMIN->value)->first()->id;
        if($authentificatedUser->id == $user->id || $authentificatedUser->role_id == $adminRole) {
            return Response::allow();
        }
        return Response::deny('У вас нет прав на просмотр данного пользователя');

    }

    public function edit(User $authentificatedUser) : Response
    {
        $adminRole = Role::where('slug', RoleEnum::ADMIN->value)->first()->id;
        if ($authentificatedUser->role_id == $adminRole) {
            return Response::allow();
        }
        return Response::deny('У вас нет прав на просмотр данной страницы');
    }

    public function update(User $authentificatedUser) : Response
    {
        $adminRole = Role::where('slug', RoleEnum::ADMIN->value)->first()->id;
        if ($authentificatedUser->role_id == $adminRole) {
            return Response::allow();
        }
        return Response::deny('У вас нет прав на выполнение данного действия');
    }

    public function delete(User $authentificatedUser)
    {
        $adminRole = Role::where('slug', RoleEnum::ADMIN->value)->first()->id;
        if ($authentificatedUser->role_id == $adminRole) {
            return Response::allow();
        }
        return Response::deny('У вас нет прав на выполнение данного действия');
    }
}
