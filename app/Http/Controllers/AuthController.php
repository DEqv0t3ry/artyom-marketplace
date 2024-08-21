<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\CreateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService,
    ){}
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
        $this->authService->createUser($request->validated());

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
        $this->authService->logoutUser();

        return redirect()->route('catalog')->with('success','Вы вышли из аккаунта');
    }
}
