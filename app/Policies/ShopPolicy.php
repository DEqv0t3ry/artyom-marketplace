<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class ShopPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user) : Response
    {
        return Auth::id() === $user->id
            ? Response::allow()
            : Response::deny('У вас нет прав на создание магазина для этого пользователя');
    }

    public function update(User $user, Shop $shop) : Response
    {
        return $user->id === $shop->user_id
            ? Response::allow()
            : Response::deny('У вас нет прав на редактирование этого магазина');
    }
}
