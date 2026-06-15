<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        $paymentAccount = auth()->user()->paymentAccount;

        if (!$paymentAccount) {

            return redirect()
                ->route('payment.create')
                ->with(
                    'error',
                    'Silakan daftar akun pembayaran terlebih dahulu.'
                );
        }

        return view(
            'payment.pay',
            compact(
                'order',
                'paymentAccount'
            )
        );
    }

    public function process(
        Request $request,
        Order $order
    )
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        $paymentAccount = auth()->user()->paymentAccount;

        if (!$paymentAccount) {

            return redirect()
                ->route('payment.create')
                ->with(
                    'error',
                    'Silakan daftar akun pembayaran terlebih dahulu.'
                );
        }

        $request->validate([
            'pin' => 'required|digits:6',
            'payment_method' => 'required'
        ]);

        if (
            !Hash::check(
                $request->pin,
                $paymentAccount->pin
            )
        ) {

            return back()->withErrors([
                'pin' => 'PIN yang Anda masukkan salah.'
            ]);
        }

        $order->update([
            'payment_status' => 'paid',
            'payment_method' => $request->payment_method,
            'paid_at' => now(),
        ]);

        return redirect()
            ->route('orders')
            ->with(
                'success',
                'Pembayaran berhasil dilakukan.'
            );
    }
}