<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function store(User $user)
    {
        if (request()->hasFile('logo'))
        {
            $logoPath = request('logo')->store('logos', 'public');
        }

        Shop::create([
            'name' => request('name'),
            'inn' => request('inn'),
            'address' => request('address'),
            'phone' => request('phone'),
            'logo' => $logoPath ?? null,
            'user_id' => $user->id,
        ]);

        return redirect()->route('users.show', $user->id);
    }
}
