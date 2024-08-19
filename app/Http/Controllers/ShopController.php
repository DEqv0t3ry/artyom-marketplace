<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function update(UpdateShopRequest $request,  Shop $shop)
    {
        if (Auth::id() !== $shop->user_id) {
            abort(403);
        }

        $shopData = $request->validated();
        $shop->update($shopData);

        return redirect()->route('users.show', $shop->user_id)->with('success', 'Номер телефона обновлен');
    }

    public function deleteLogo(Shop $shop)
    {
        if($shop->logo) {
            Storage::disk('public')->delete($shop->logo);
            $shop->update([
                'logo' => null
            ]);
        }
    }
}
