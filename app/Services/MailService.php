<?php

namespace App\Services;

use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendOrder(Order $order)
    {
        Mail::to($order->email)->send(new OrderMail($order));
    }
}
