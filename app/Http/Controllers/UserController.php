<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function products_show(User $user)
    {
        return view('users.products', compact('user'));
    }
}
