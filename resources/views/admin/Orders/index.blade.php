@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h3 class="fw-bold mb-0">
                    📦 Pesanan Masuk
                </h3>

            </div>

            @if(session('success'))

                <div class="alert alert-success">

                    {{ session('success') }}

                </div>

            @endif

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="70">
                                ID
                            </th>

                            <th>
                                Pemesan
                            </th>

                            <th>
                                Produk
                            </th>

                            <th width="150">
                                Total
                            </th>

                            <th width="180">
                                Pembayaran
                            </th>

                            <th>
                                Alamat
                            </th>

                            <th width="140">
                                Pengiriman
                            </th>

                            <th width="220">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($orders as $order)

                            <tr>

                                <td>

                                    #{{ $order->id }}

                                </td>

                                <td>

                                    <strong>

                                        {{ $order->receiver_name ?? '-' }}

                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        {{ $order->phone ?? '-' }}

                                    </small>

                                    <br>

                                    <small class="text-primary">

                                        {{ $order->user->name ?? '-' }}

                                    </small>

                                </td>

                                <td>

                                    @foreach($order->items as $item)

                                        <div class="mb-2">

                                            <strong>

                                                {{ $item->product->name ?? '-' }}

                                            </strong>

                                            <br>

                                            <small>

                                                Qty : {{ $item->qty }}

                                            </small>

                                        </div>

                                    @endforeach

                                </td>

                                <td>

                                    <strong>

                                        Rp {{ number_format($order->total_price,0,',','.') }}

                                    </strong>

                                </td>

                                <td>

                                    @if($order->payment_status == 'paid')

                                        <span class="badge bg-success mb-2">

                                            ✅ Sudah Dibayar

                                        </span>

                                        <br>

                                        <small>

                                            {{ $order->payment_method ?? '-' }}

                                        </small>

                                        <br>

                                        <small class="text-muted">

                                            {{ $order->paid_at ? $order->paid_at->format('d M Y H:i') : '-' }}

                                        </small>

                                    @else

                                        <span class="badge bg-danger">

                                            ❌ Belum Dibayar

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    {{ $order->shipping_address ?? '-' }}

                                </td>

                                <td>

                                    @if($order->shipping_status == 'pending')

                                        <span class="badge bg-warning">

                                            Menunggu

                                        </span>

                                    @elseif($order->shipping_status == 'processing')

                                        <span class="badge bg-primary">

                                            Diproses

                                        </span>

                                    @elseif($order->shipping_status == 'shipped')

                                        <span class="badge bg-success">

                                            Dikirim

                                        </span>

                                    @elseif($order->shipping_status == 'completed')

                                        <span class="badge bg-dark">

                                            Selesai

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            -

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    @if($order->payment_status == 'paid')

                                        <form
                                            action="{{ route('admin.orders.update', $order->id) }}"
                                            method="POST">

                                            @csrf
                                            @method('PUT')

                                            <select
                                                name="shipping_status"
                                                class="form-select mb-2">

                                                <option
                                                    value="pending"
                                                    {{ $order->shipping_status == 'pending' ? 'selected' : '' }}>
                                                    Menunggu
                                                </option>

                                                <option
                                                    value="processing"
                                                    {{ $order->shipping_status == 'processing' ? 'selected' : '' }}>
                                                    Diproses
                                                </option>

                                                <option
                                                    value="shipped"
                                                    {{ $order->shipping_status == 'shipped' ? 'selected' : '' }}>
                                                    Dikirim
                                                </option>

                                                <option
                                                    value="completed"
                                                    {{ $order->shipping_status == 'completed' ? 'selected' : '' }}>
                                                    Selesai
                                                </option>

                                            </select>

                                            <button
                                                type="submit"
                                                class="btn btn-success btn-sm w-100">

                                                Simpan Status

                                            </button>

                                        </form>

                                    @else

                                        <button
                                            class="btn btn-secondary btn-sm w-100"
                                            disabled>

                                            Menunggu Pembayaran

                                        </button>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center">

                                    Belum ada pesanan masuk.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection