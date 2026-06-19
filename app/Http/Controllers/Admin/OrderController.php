<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }

    public function accept($id)
{
    $order = Order::findOrFail($id);

    $order->update([
        'status' => 'Accepted'
    ]);

    return back()->with(
        'success',
        'Order accepted'
    );
}
   public function reject($id)
{
    $order = Order::findOrFail($id);

    $order->update([
        'status' => 'Rejected'
    ]);

    return back()->with(
        'success',
        'Order rejected'
    );
}
}