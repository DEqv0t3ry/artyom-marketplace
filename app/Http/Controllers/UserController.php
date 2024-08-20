<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateShopRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->get();

        return view('admin.users', ['users' => $users]);
    }
    public function show(User $user)
    {
        if ($user->can('view', $user)) {
            return view('users.show', compact('user'));
        }
    }

    public function products_show(User $user)
    {
        return view('users.products', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $requestUser, UpdateShopRequest $requestShop, User $user)
    {
        $userData = $requestUser->validated();
        $shopData = $requestShop->validated();

        if ($userData['password'] == null) {
            unset($userData['password']);
        }

        if($requestShop->hasFile('logo')) {
            $shopData['logo'] = $requestShop->file('logo')->store('logos', 'public');

            if ($user->shop && $user->shop->logo)
            {
                Storage::disk('public')->delete($user->shop->logo);
            }
        }

        $user->update($userData);

        $user->shop ?$user->shop->update($shopData) : $user->shop()->create($shopData);

        return redirect()->route('admin.index')->with('success','Данные продавца успешно обновлены');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success','Пользователь успешно удалён');
    }
}
