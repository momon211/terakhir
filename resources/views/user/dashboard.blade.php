@extends('layouts.app')

@section('content')

<div class="container">

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif

    <div class="card shadow mb-4">

        <div class="card-header bg-success text-white">

            Dashboard Pelanggan

        </div>

        <div class="card-body">

            <h3>

                Selamat Datang,
                {{ auth()->user()->name }}

            </h3>

            <p class="text-muted">

                Selamat berbelanja di Toko Bunga Kami 🌹

            </p>

            <hr>

            <p>

                <strong>Email :</strong>

                {{ auth()->user()->email }}

            </p>

            <p>

                <strong>Role :</strong>

                {{ auth()->user()->role }}

            </p>

        </div>

    </div>

    <div class="card shadow mb-4">

        <div class="card-header bg-primary text-white">

            Akun Pembayaran

        </div>

        <div class="card-body">

            @if(auth()->user()->paymentAccount)

                <div class="row">

                    <div class="col-md-4 mb-2">

                        <a href="{{ route('payment.edit') }}"
                           class="btn btn-warning w-100">

                            ✏ Edit Akun Pembayaran

                        </a>

                    </div>

                    <div class="col-md-4 mb-2">

                        <a href="{{ route('payment.change-pin.form') }}"
                           class="btn btn-dark w-100">

                            🔐 Ganti PIN

                        </a>

                    </div>

                    <div class="col-md-4 mb-2">

                        <button
                            class="btn btn-success w-100"
                            disabled>

                            ✔ Akun Pembayaran Aktif

                        </button>

                    </div>

                </div>

            @else

                <div class="alert alert-warning">

                    Anda belum memiliki akun pembayaran.

                </div>

                <a href="{{ route('payment.create') }}"
                   class="btn btn-primary">

                    ➕ Daftar Akun Pembayaran

                </a>

            @endif

        </div>

    </div>

    <div class="card shadow">

        <div class="card-header">

            Menu Cepat

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <a href="{{ route('store') }}"
                       class="btn btn-success w-100">

                        🛍 Lihat Toko

                    </a>

                </div>

                <div class="col-md-4 mb-3">

                    <a href="{{ route('orders') }}"
                       class="btn btn-primary w-100">

                        📦 Pesanan Saya

                    </a>

                </div>

                <div class="col-md-4 mb-3">

                    <a href="{{ route('payment.create') }}"
                       class="btn btn-warning w-100">

                        💳 Pembayaran

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection