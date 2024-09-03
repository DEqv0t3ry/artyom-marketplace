<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{

    public function view(User $authenticatedUser, User $user): Response
    {
        if($authenticatedUser->id == $user->id) {
            return Response::allow();
        }
        return Response::deny('У вас нет прав на просмотр заказов данного пользователя');
    }
}
