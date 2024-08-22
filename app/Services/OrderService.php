<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderService
{
    public function __construct(
        private readonly MailService $mailService,
    )
    {
    }

    public function getOrders(User $user)
    {
        return $user->products->flatMap->orders->sortByDesc('created_at')
            ->when(request()->has('sort') && request('sort') == 'unprocessed', function ($orders) {
            return $orders->sortBy('processed');
        });
    }

    public function createOrder($request,  Product $product)
    {
        $request['product_id'] = $product->id;
        $request['processed'] = false;
        $request['phone'] = $this->phoneClear($request['phone']);

        $order = Order::create($request);

        $this->mailService->sendOrder($order);
    }

    public function phoneClear($phone){
        $phone = mb_eregi_replace("[^0-9]", '', $phone);
        if(strlen($phone) > 9){
            $data = '+7'.substr($phone, -10);
        }
        else $data = '';
        return $data;
    }

    public function changeOrderStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|bool'
        ]);
        $order->update([
            'processed' => $request->get('status') ? 1 : 0
        ]);

        return $order;
    }
}
