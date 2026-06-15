@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <h3 class="fw-bold mb-3">
                📍 Data Pengiriman
            </h3>

            <p class="text-muted">
                Lengkapi data penerima dan alamat pengiriman pesanan Anda.
            </p>

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('order.confirm', $order->id) }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Nama Penerima
                    </label>

                    <input
                        type="text"
                        name="receiver_name"
                        class="form-control"
                        value="{{ old('receiver_name') }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Nomor HP
                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Alamat Lengkap
                    </label>

                    <textarea
                        name="shipping_address"
                        rows="5"
                        class="form-control"
                        required>{{ old('shipping_address') }}</textarea>

                </div>

                <div class="card bg-light border-0 mb-3">

                    <div class="card-body">

                        <h6 class="fw-bold">
                            Ringkasan Pesanan
                        </h6>

                        <hr>

                        <div class="d-flex justify-content-between">

                            <span>
                                Nomor Pesanan
                            </span>

                            <strong>
                                #{{ $order->id }}
                            </strong>

                        </div>

                        <div class="d-flex justify-content-between mt-2">

                            <span>
                                Total Pembayaran
                            </span>

                            <strong class="text-success">

                                Rp {{ number_format($order->total_price,0,',','.') }}

                            </strong>

                        </div>

                    </div>

                </div>

                <button
                    type="submit"
                    class="btn btn-success w-100">

                     Buat Pesanan

                </button>

            </form>

        </div>

    </div>

</div>

@endsection