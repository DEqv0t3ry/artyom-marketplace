<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Http\Requests\UpdateShopRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserService
{
    public function getUsers()
    {
        $roleId = Role::where('slug',RoleEnum::SHOP->value)->first()->id;
        return User::where('role_id', $roleId)->get();
    }

    public function updateUser(array $requestUser, UpdateShopRequest $requestShop, User $user)
    {
        $shopData = $requestShop->validated();

        if ($requestUser['password'] == null) {
            unset($requestUser['password']);
        }

        if($requestShop->hasFile('logo')) {
            $shopData['logo'] = $requestShop->file('logo')->store('logos', 'public');

            $user->shop && $user->shop->logo ? Storage::disk('public')->delete($user->shop->logo) : null;
        }

        $user->update($requestUser);

        $user->shop ? $user->shop->update($shopData) : $user->shop()->create($shopData);
    }

    public function deleteUser(User $user)
    {
        $user->shop && $user->shop->logo ? Storage::disk('public')->delete($user->shop->logo) : null;

        foreach ($user->products as $product) {
           $product->thumbnail ? Storage::disk('public')->delete($product->thumbnail) : null;
        }

        foreach ($user->photos as $photo) {
            Storage::disk('public')->delete($photo->photo);
        }

        return $user->delete();
    }
}
