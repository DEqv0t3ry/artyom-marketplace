<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeOrderStatusRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
    ) {
    }

    public function index(User $user)
    {
        return view('users.orders',
            [
                'orders' => $this->orderService->getOrders($user)
            ],
            compact('user') );
    }

    public function store(CreateOrderRequest $request,  Product $product)
    {
        $this->orderService->createOrder($request->validated(), $product);

        return redirect()->route('catalog')->with('success', 'Заказ оформлен');
    }

    public function changeStatus(ChangeOrderStatusRequest $request, Order $order)
    {
        $this->orderService->changeOrderStatus($request->validated(), $order);
    }
}
