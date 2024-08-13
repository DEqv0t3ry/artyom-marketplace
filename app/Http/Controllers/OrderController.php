<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Product $product)
    {
        //var_dump($product->id);

        Order::create(
            [
                'name' => request('name'),
                'email' => request('email'),
                'phone' => request('phone'),
                'count' => request('count'),
                'product_id' => $product->id
            ]
        );

        return redirect()->route('catalog')->with('success', 'Заказ оформлен');
    }
}
