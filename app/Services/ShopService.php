<?php

namespace App\Services;

use App\Http\Requests\CreateShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use MoveMoveIo\DaData\Enums\BranchType;
use MoveMoveIo\DaData\Enums\CompanyType;
use MoveMoveIo\DaData\Facades\DaDataCompany;

class ShopService
{
    public function createShop(CreateShopRequest $request, User $user)
    {

        $shopData = $request->validated();
        $shopData['user_id'] = $user->id;

        $request->hasFile('logo') ?
            $shopData['logo'] = $shopData['logo']->store('logos', 'public')
            : null;

        return Shop::create($shopData);
    }

    public function updateShop(UpdateShopRequest $request, Shop $shop)
    {
        $shopData = $request->validated();

        if($request->hasFile('logo')) {
            $shopData['logo'] = $request->file('logo')->store('logos', 'public');

            $shop->logo ? Storage::disk('public')->delete($shop->logo) : null;
        }

        return $shop->update($shopData);
    }

    public function deleteLogo(Shop $shop)
    {
        if($shop->logo) {
            Storage::disk('public')->delete($shop->logo);
            $shop->logo = null;
            $shop->save();
        }
    }

    public function checkInn(Request $inn)
    {
        try {
            $dadata = DaDataCompany::id($inn['inn'], 1, null, BranchType::MAIN, CompanyType::LEGAL);
            return $dadata['suggestions'][0]['data']['address']['value'];
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return 'Не удалось получить адрес по ИНН';
        }
    }
}
