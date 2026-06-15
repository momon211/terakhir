@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <h2 class="fw-bold mb-4">
                📦 Pesanan Saya
            </h2>

            <div class="row mb-4">

                <div class="col">
                    <a href="{{ route('orders',['status'=>'pending']) }}"
                       class="btn {{ $status == 'pending' ? 'btn-warning' : 'btn-outline-warning' }} w-100">
                        ⏳ Menunggu
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('orders',['status'=>'processing']) }}"
                       class="btn {{ $status == 'processing' ? 'btn-primary' : 'btn-outline-primary' }} w-100">
                        ⚙️ Diproses
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('orders',['status'=>'shipped']) }}"
                       class="btn {{ $status == 'shipped' ? 'btn-success' : 'btn-outline-success' }} w-100">
                        🚚 Dikirim
                    </a>
                </div>

                <div class="col">
                    <a href="{{ route('orders',['status'=>'completed']) }}"
                       class="btn {{ $status == 'completed' ? 'btn-dark' : 'btn-outline-dark' }} w-100">
                        ✔ Selesai
                    </a>
                </div>

            </div>

            @forelse($orders as $order)

                <div class="card mb-4 shadow-sm border-0">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>

                                <h3 class="fw-bold">
                                    Pesanan #{{ $order->id }}
                                </h3>

                                <div class="text-muted">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </div>

                                <div class="mt-2">

                                    @if($order->payment_status == 'paid')

                                        <span class="badge bg-success">
                                            ✅ Sudah Dibayar
                                        </span>

                                        <div class="small text-muted mt-1">
                                            {{ $order->payment_method }}
                                        </div>

                                    @else

                                        <span class="badge bg-danger">
                                            ❌ Belum Dibayar
                                        </span>

                                    @endif

                                </div>

                            </div>

                            <div class="text-end">

                                @if($order->payment_status != 'paid')

                                    <a href="{{ route('payment.show',$order->id) }}"
                                       class="btn btn-warning mb-2">
                                        💳 Bayar Sekarang
                                    </a>

                                    <br>

                                    <span class="badge bg-danger">
                                        Menunggu Pembayaran
                                    </span>

                                @elseif($order->shipping_status == 'pending')

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

                                @endif

                            </div>

                        </div>

                        <hr>

                        <div class="row">

                            <div class="col-md-4">

                                <h4 class="fw-bold mb-3">
                                    Data Penerima
                                </h4>

                                <table class="table table-borderless">

                                    <tr>
                                        <td width="140">Nama</td>
                                        <td>{{ $order->receiver_name }}</td>
                                    </tr>

                                    <tr>
                                        <td>No HP</td>
                                        <td>{{ $order->phone }}</td>
                                    </tr>

                                </table>

                            </div>

                            <div class="col-md-8">

                                <h4 class="fw-bold mb-3">
                                    Alamat Pengiriman
                                </h4>

                                <p>
                                    {{ $order->shipping_address }}
                                </p>

                            </div>

                        </div>

                        <hr>

                        <h4 class="fw-bold mb-3">
                            Produk Dipesan
                        </h4>

                        <div class="table-responsive">

                            <table class="table table-bordered">

                                <thead>

                                    <tr>

                                        <th>Produk</th>
                                        <th width="120">Qty</th>
                                        <th width="200">Harga</th>
                                        <th width="200">Subtotal</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($order->items as $item)

                                        <tr>

                                            <td>
                                                {{ $item->product->name }}
                                            </td>

                                            <td>
                                                {{ $item->qty }}
                                            </td>

                                            <td>
                                                Rp {{ number_format($item->price,0,',','.') }}
                                            </td>

                                            <td>
                                                Rp {{ number_format($item->price * $item->qty,0,',','.') }}
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        <div class="text-end">

                            <h2 class="fw-bold text-success">

                                Rp {{ number_format($order->total_price,0,',','.') }}

                            </h2>

                        </div>

                        @if($order->shipping_status == 'completed')

                            <form
                                action="{{ route('order.destroy',$order->id) }}"
                                method="POST"
                                class="mt-3">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="btn btn-danger"
                                    onclick="return confirm('Hapus pesanan ini?')">

                                    🗑 Hapus Pesanan

                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            @empty

                <div class="alert alert-warning">

                    Belum ada pesanan.

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection