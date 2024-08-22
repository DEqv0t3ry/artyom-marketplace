<?php

namespace App\Services;

use App\Http\Requests\ChangeOrderStatusRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderService
{
    public function __construct(
        private readonly MailService $mailService,
    ){
    }

    public function getOrders(User $user)
    {
        return $user->orders()
            ->when(
                !request()->has('sort') || request('sort') == 'date',
                function ($orders) {
                    return $orders->latest();
                }
            )
            ->when(
                request()->has('sort') && request('sort') == 'unprocessed',
                function ($orders) {
                    return $orders->orderBy('processed');
                }
            )->get();
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

    public function changeOrderStatus(array $request, Order $order)
    {
        $order->update([
            'processed' => $request['status'] ? 1 : 0
        ]);

        return $order;
    }
}
