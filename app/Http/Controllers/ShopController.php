<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShopRequest;
use App\Http\Requests\UpdateShopRequest;
use App\Models\Shop;
use App\Models\User;
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use MoveMoveIo\DaData\Enums\BranchType;
use MoveMoveIo\DaData\Enums\CompanyType;
use MoveMoveIo\DaData\Facades\DaDataCompany;

class ShopController extends Controller
{
    public function __construct(
        private readonly ShopService $shopService
    ){}

    public function store(CreateShopRequest $request,  User $user)
    {
        $this->shopService->createShop($request, $user);

        return redirect()->route('users.show', $user->id);
    }
    public function update(UpdateShopRequest $request,  Shop $shop)
    {
        $this->shopService->updateShop($request, $shop);

        return redirect()->route('users.show', $shop->user_id)->with('success', 'Номер телефона обновлен');
    }

    public function deleteLogo(Shop $shop)
    {
        $this->shopService->deleteLogo($shop);
    }

    public function checkInn(Request $inn)
    {
        return response()->json(['address' => $this->shopService->checkInn($inn)]);
    }
}
