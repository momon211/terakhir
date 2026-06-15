<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'user',
            'items.product'
        ])
        ->latest()
        ->get();

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }

    public function updateStatus(
        Request $request,
        Order $order
    )
    {
        if ($order->payment_status !== 'paid') {

            return back()->with(
                'error',
                'Pesanan belum dibayar oleh pelanggan.'
            );
        }

        $request->validate([
            'shipping_status' => 'required|in:pending,processing,shipped,completed'
        ]);

        $statusMap = [
            'pending'    => 'menunggu',
            'processing' => 'diproses',
            'shipped'    => 'dikirim',
            'completed'  => 'selesai',
        ];

        $order->update([
            'shipping_status' => $request->shipping_status,
            'status' => $statusMap[$request->shipping_status],
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }
}