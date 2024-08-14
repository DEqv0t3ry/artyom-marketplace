<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function authenticate()
    {
        if (auth()->attempt([
            'email' => request('email'),
            'password' => request('password')
        ]))
        {
            request()->session()->regenerate();

            return redirect()->route('users.show', Auth::id())->with('success','Вы успешно вошли');
        }

        return back()->withErrors([
            'email' => 'Неверный логин или пароль'
        ])->onlyInput('email');
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('catalog')->with('success','Вы вышли из аккаунта');
    }
}
