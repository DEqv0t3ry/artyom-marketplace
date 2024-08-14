<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function store(User $user)
    {

        $role = Role::where('slug', RoleEnum::SHOP->value)->first();
        User::create([
            'email' => request('email'),
            'password' => request('password'),
            'role_id' => $role->id
        ]);

        return redirect()->route('catalog')->with('success','Аккаунт успешно создан');
    }
}
