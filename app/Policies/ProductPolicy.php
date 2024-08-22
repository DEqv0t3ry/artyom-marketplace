<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Product $product): Response
    {
        if($product->on_sale == true)
        {
            return Response::allow();
        }
        return Response::deny('Этот продукт не доступен');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function edit(User $user, Product $product): Response
    {
        return $user->id === $product->user_id
            ? Response::allow()
            : Response::deny('У вас нет прав на просмотр и редактирование этого продукта');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): Response
    {
        return $user->id === $product->user_id
            ? Response::allow()
            : Response::deny('У вас нет прав на редактирование этого продукта');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): Response
    {
        return $user->id === $product->user_id
            ? Response::allow()
            : Response::deny('У вас нет прав на удаление этого продукта');
    }
}
