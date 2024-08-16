<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(User $user)
    {
        return view('users.orders', compact('user'));
    }
    public function store(Product $product)
    {
        //var_dump($product->id);

        Order::create(
            [
                'name' => request('name'),
                'email' => request('email'),
                'phone' => request('phone'),
                'count' => request('count'),
                'processed' => false,
                'product_id' => $product->id
            ]
        );

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
