<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\CreateUserRequest;
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

    public function store(CreateUserRequest $request)
    {
        $roleId = Role::where('slug', RoleEnum::SHOP->value)->first()->id;
        $userData = $request->validated();
        $userData['role_id'] = $roleId;
        User::create($userData);

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

            //dd(User::orderBy('created_at', 'desc'));

            if(Auth::user()->role_id == Role::where('slug',RoleEnum::ADMIN->value)->first()->id) {
                return redirect()->route('admin.index')->with('success','Вы успешно вошли');
            }
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
