<?php

namespace App\Services;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderService
{
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
        return Order::create($request);
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
