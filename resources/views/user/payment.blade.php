@extends('layouts.app')

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <h3 class="mb-4">
            📍 Alamat Pengiriman
        </h3>

        <form action="{{ route('order.confirm', $order->id) }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Nama Penerima
                </label>

                <input type="text"
                       name="receiver_name"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Nomor HP
                </label>

                <input type="text"
                       name="phone"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Alamat Lengkap
                </label>

                <textarea name="shipping_address"
                          rows="5"
                          class="form-control"
                          required></textarea>

            </div>

            <button class="btn btn-success">
                Buat Pesanan
            </button>

        </form>

    </div>

</div>

@endsection