<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(User $user)
    {
        $orders = $user->products->flatMap->orders->sortByDesc('created_at');
        if (request()->has('sort') && request('sort') == 'unprocessed') {
                $orders = $user->products->flatMap->orders->sortBy('processed');
        }

        return view('users.orders', ['orders' => $orders], compact('user') );
    }

    public function store(CreateOrderRequest $request,  Product $product)
    {
        $productId = $product->id;
        $orderData = $request->validated();
        $orderData['product_id'] = $productId;
        $orderData['processed'] = false;
        Order::create($orderData);

        return redirect()->route('catalog')->with('success', 'Заказ оформлен');
    }

    public function changeStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|bool'
        ]);
        $order->update([
            'processed' => $request->get('status') ? 1 : 0
        ]);

        //dd($request->get('status'));

        return $order;
    }
}
