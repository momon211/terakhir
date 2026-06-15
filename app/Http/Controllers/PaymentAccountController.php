<?php

namespace App\Http\Controllers;

use App\Models\PaymentAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PaymentAccountController extends Controller
{
    /**
     * Tampilkan form registrasi akun pembayaran.
     */
    public function create()
    {
        $paymentAccount = auth()->user()->paymentAccount;

        if ($paymentAccount) {

            return redirect()
                ->route('dashboard')
                ->with(
                    'success',
                    'Akun pembayaran sudah terdaftar.'
                );
        }

        return view('payment.create');
    }

    /**
     * Simpan akun pembayaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|max:255',
            'bank' => 'required|in:BRI,BCA,MANDIRI,BSI,BNI,',
            'account_number' => 'required|unique:payment_accounts,account_number',
            'pin' => 'required|digits:6|confirmed',
        ], [
            'pin.confirmed' => 'Konfirmasi PIN tidak sesuai.',
            'pin.digits' => 'PIN harus 6 digit.',
        ]);

        PaymentAccount::create([
            'user_id' => auth()->id(),
            'full_name' => $request->full_name,
            'bank' => $request->bank,
            'account_number' => $request->account_number,
            'pin' => Hash::make($request->pin),
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Akun pembayaran berhasil didaftarkan.'
            );
    }

    /**
     * Tampilkan form edit akun pembayaran.
     */
    public function edit()
    {
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
            'payment.edit',
            compact('paymentAccount')
        );
    }

    /**
     * Update akun pembayaran.
     */
    public function update(Request $request)
    {
        $paymentAccount = auth()->user()->paymentAccount;

        if (!$paymentAccount) {

            return redirect()
                ->route('payment.create');
        }

        $request->validate([
            'full_name' => 'required|max:255',
            'bank' => 'required|in:BRI,BCA,MANDIRI,BSI,BNI',
            'account_number' => 'required|unique:payment_accounts,account_number,' . $paymentAccount->id,
        ]);

        $paymentAccount->update([
            'full_name' => $request->full_name,
            'bank' => $request->bank,
            'account_number' => $request->account_number,
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Data akun pembayaran berhasil diperbarui.'
            );
    }

    /**
     * Form ganti PIN.
     */
    public function changePinForm()
    {
        $paymentAccount = auth()->user()->paymentAccount;

        if (!$paymentAccount) {

            return redirect()
                ->route('payment.create');
        }

        return view('payment.change-pin');
    }

    /**
     * Simpan PIN baru.
     */
    public function changePin(Request $request)
    {
        $paymentAccount = auth()->user()->paymentAccount;

        if (!$paymentAccount) {

            return redirect()
                ->route('payment.create');
        }

        $request->validate([
            'old_pin' => 'required',
            'new_pin' => 'required|digits:6|confirmed',
        ]);

        if (!Hash::check(
            $request->old_pin,
            $paymentAccount->pin
        )) {

            return back()->withErrors([
                'old_pin' => 'PIN lama tidak sesuai.'
            ]);
        }

        $paymentAccount->update([
            'pin' => Hash::make(
                $request->new_pin
            )
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'PIN berhasil diperbarui.'
            );
    }
}