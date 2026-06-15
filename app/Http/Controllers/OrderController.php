<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $qty = (int) $request->qty;

        if ($qty < 1) {

            return back()->with(
                'error',
                'Jumlah pembelian minimal 1.'
            );
        }

        if ($qty > $product->stock) {

            return back()->with(
                'error',
                'Stok produk tidak mencukupi. Stok tersedia hanya '.$product->stock.' item.'
            );
        }

        $total = $product->price * $qty;

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'payment_status' => 'pending',
            'shipping_status' => 'pending',
            'status' => 'menunggu',
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'qty' => $qty,
            'price' => $product->price,
        ]);

        $product->decrement('stock', $qty);

        return redirect()
            ->route('shipping', $order->id)
            ->with(
                'success',
                'Silakan isi data pengiriman.'
            );
    }

    public function shipping(Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        return view('user.shipping', compact('order'));
    }

    public function confirm(Request $request, Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'receiver_name' => 'required|max:255',
            'phone' => 'required|max:20',
            'shipping_address' => 'required|min:10',
        ]);

        $order->update([
            'receiver_name' => $request->receiver_name,
            'phone' => $request->phone,
            'shipping_address' => $request->shipping_address,
            'status' => 'menunggu',
        ]);

        return redirect()
            ->route('payment.show', $order->id)
            ->with(
                'success',
                'Silakan lanjut ke pembayaran.'
            );
    }

    public function orders(Request $request)
    {
        $status = $request->get('status', 'pending');

        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->where('shipping_status', $status)
            ->latest()
            ->get();

        return view('user.orders', [
            'orders' => $orders,
            'status' => $status
        ]);
    }

    public function destroy(Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        if ($order->status !== 'selesai') {

            return back()->with(
                'error',
                'Pesanan hanya bisa dihapus jika sudah selesai.'
            );
        }

        $order->delete();

        return back()->with(
            'success',
            'Pesanan berhasil dihapus.'
        );
    }
}