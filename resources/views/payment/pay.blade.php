@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card shadow border-0">

        <div class="card-header bg-success text-white">

            <h4 class="mb-0">
                💳 Pembayaran Pesanan
            </h4>

        </div>

        <div class="card-body">

            @if(session('error'))

                <div class="alert alert-danger">

                    {{ session('error') }}

                </div>

            @endif

            @if($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="row">

                <div class="col-md-6">

                    <div class="card bg-light border-0 mb-3">

                        <div class="card-body">

                            <h5 class="fw-bold">
                                Detail Pesanan
                            </h5>

                            <hr>

                            <p>

                                <strong>ID Pesanan :</strong>

                                #{{ $order->id }}

                            </p>

                            <p>

                                <strong>Nama Penerima :</strong>

                                {{ $order->receiver_name }}

                            </p>

                            <p>

                                <strong>No HP :</strong>

                                {{ $order->phone }}

                            </p>

                            <p>

                                <strong>Alamat :</strong>

                                {{ $order->shipping_address }}

                            </p>

                            <p>

                                <strong>Total Pembayaran :</strong>

                                <span class="text-success fw-bold">

                                    Rp {{ number_format($order->total_price,0,',','.') }}

                                </span>

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="card border-success">

                        <div class="card-body">

                            <h5 class="fw-bold mb-3">

                                Data Rekening Anda

                            </h5>

                            <hr>

                            <p>

                                <strong>Nama Lengkap :</strong>

                                {{ $paymentAccount->full_name }}

                            </p>

                            <p>

                                <strong>Bank :</strong>

                                {{ $paymentAccount->bank }}

                            </p>

                            <p>

                                <strong>No Rekening :</strong>

                                {{ $paymentAccount->account_number }}

                            </p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card border-primary mt-4">

                <div class="card-header bg-primary text-white">

                    Transfer Ke Rekening Toko

                </div>

                <div class="card-body">

                    <div class="alert alert-warning">

                        <strong>
                            Silakan transfer ke rekening berikut:
                        </strong>

                    </div>

                    <table class="table table-bordered">

                        <tr>

                            <th width="200">
                                Nama Bank
                            </th>

                            <td>
                                BCA
                            </td>

                        </tr>

                        <tr>

                            <th>
                                Nomor Rekening
                            </th>

                            <td>
                                1234567890
                            </td>

                        </tr>

                        <tr>

                            <th>
                                Atas Nama
                            </th>

                            <td>
                                TOKO BUNGA FLORIST
                            </td>

                        </tr>

                    </table>

                </div>

            </div>

            <div class="card mt-4">

                <div class="card-header">

                    Konfirmasi Pembayaran

                </div>

                <div class="card-body">

                    <form action="{{ route('payment.process', $order->id) }}"
                          method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label fw-bold">

                                Pilih Bank Pembayaran

                            </label>

                            <select
                                name="payment_method"
                                class="form-select"
                                required>

                                <option value="">
                                    -- Pilih Bank --
                                </option>

                                <option value="BRI">
                                    BRI
                                </option>

                                <option value="BCA">
                                    BCA
                                </option>

                                <option value="MANDIRI">
                                    MANDIRI
                                </option>

                                <option value="BSI">
                                    BSI
                                </option>

                                <option value="BNI">
                                    BNI
                                </option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-bold">

                                Masukkan PIN Pembayaran

                            </label>

                            <input
                                type="password"
                                name="pin"
                                maxlength="6"
                                class="form-control"
                                placeholder="******"
                                required>

                            <small class="text-muted">

                                Masukkan PIN 6 digit yang Anda buat saat mendaftar akun pembayaran.

                            </small>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-success w-100">

                            💳 Bayar Sekarang

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection