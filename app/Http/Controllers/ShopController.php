<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShopRequest;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function store(CreateShopRequest $request,  User $user)
    {
        $userId = $user->id;
        $shopData = $request->validated();
        $shopData['user_id'] = $userId;

        if ($request->hasFile('logo'))
        {
            $shopData['logo'] = $shopData['logo']->store('logos', 'public');
        }

        Shop::create($shopData);

        return redirect()->route('users.show', $user->id);
    }
}
