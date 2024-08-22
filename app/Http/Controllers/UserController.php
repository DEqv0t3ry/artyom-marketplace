<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateShopRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ){}

    public function index()
    {
        return view('admin.users', ['users' => $this->userService->getUsers()]);
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
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
        $this->userService->updateUser($requestUser->validated(), $requestShop, $user);

        return redirect()->route('admin.index')->with('success','Данные продавца успешно обновлены');
    }

    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return redirect()->route('admin.index')->with('success','Пользователь успешно удалён');
    }
}
