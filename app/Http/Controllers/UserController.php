<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->get();

        return view('admin.users', ['users' => $users]);
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

    public function update(Request $request, User $user)
    {
        $validatedShop = $request->validate([
            'logo' => 'image',
            'name' => 'required',
            'inn' => 'required',
            'address' => 'required',
            'phone' => ''
        ]);
        $validatedUser = $request->validate([
            'email' => 'required',
        ]);
        if($request['password'])
        {
            $validatedUser['password'] = $request->password;
        }

        $user->shop->update($validatedShop);
        $user->update($validatedUser);

        return redirect()->route('admin.index')->with('success','Данные продавца успешно обновлены');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success','Пользователь успешно удалён');
    }
}
