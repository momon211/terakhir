@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm mb-4"
         style="background:linear-gradient(135deg,#f3f4f6,#f3f4f6); border-radius:20px;">

        <div class="card-body p-4 d-flex justify-content-between align-items-center">

            <div>

                <h4 class="fw-bold mb-1">
                    Selamat datang, {{ auth()->user()->name }} 👋
                </h4>

                <p class="text-muted mb-0">
                    Berikut ringkasan toko bunga Anda.
                </p>

            </div>

            <div style="font-size:50px">
                🌸
            </div>

        </div>

    </div>

    <div class="row mb-4">

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Kategori
                    </small>

                    <h3 class="fw-bold">
                        {{ $totalKategori }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Produk
                    </small>

                    <h3 class="fw-bold">
                        {{ $totalProduk }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Total Stok
                    </small>

                    <h3 class="fw-bold">
                        {{ $totalStok }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Nilai Inventaris
                    </small>

                    <h5 class="fw-bold">
                        Rp {{ number_format($totalNilaiInventaris,0,',','.') }}
                    </h5>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Total Pesanan
                    </small>

                    <h3 class="fw-bold text-primary">
                        {{ $totalPesanan }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Sudah Dibayar
                    </small>

                    <h3 class="fw-bold text-success">
                        {{ $pesananDibayar }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Belum Dibayar
                    </small>

                    <h3 class="fw-bold text-danger">
                        {{ $pesananBelumDibayar }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <small class="text-muted">
                        Total Omzet
                    </small>

                    <h5 class="fw-bold text-success">
                        Rp {{ number_format($totalPenjualan,0,',','.') }}
                    </h5>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-7 mb-4">

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">

                    <strong>
                        Produk Terbaru
                    </strong>

                </div>

                <div class="card-body">

                    @forelse($produkTerbaru as $produk)

                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div>

                                <strong>
                                    {{ $produk->name }}
                                </strong>

                                <br>

                                <small class="text-muted">
                                    Rp {{ number_format($produk->price,0,',','.') }}
                                </small>

                            </div>

                        </div>

                    @empty

                        <p class="text-muted">
                            Belum ada produk.
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

        <div class="col-lg-5 mb-4">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <strong>
                        Stok Menipis
                    </strong>

                </div>

                <div class="card-body">

                    @forelse($stokMenipis as $produk)

                        <div class="d-flex justify-content-between mb-3">

                            <span>
                                {{ $produk->name }}
                            </span>

                            <span class="badge bg-danger">
                                {{ $produk->stock }}
                            </span>

                        </div>

                    @empty

                        <p class="text-muted">
                            Tidak ada stok menipis.
                        </p>

                    @endforelse

                </div>

            </div>

            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white">

                    <strong>
                        📈 Grafik Penjualan 7 Hari Terakhir
                    </strong>

                </div>

                <div class="card-body">

                    <canvas id="salesChart" height="220"></canvas>

                </div>

            </div>

        </div>

    </div>

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white">

            <strong>
                📦 Pesanan Masuk
            </strong>

        </div>

        <div class="card-body">

            @forelse($pesananMasuk as $order)

                <div class="border rounded p-3 mb-3">

                    <h6 class="fw-bold">
                        {{ $order->user->name }}
                    </h6>

                    <p class="mb-1">
                        <strong>Alamat:</strong>
                        {{ $order->shipping_address ?? '-' }}
                    </p>

                    <p class="mb-1">
                        <strong>Telepon:</strong>
                        {{ $order->phone ?? '-' }}
                    </p>

                    <p class="mb-1">
                        <strong>Total:</strong>
                        Rp {{ number_format($order->total_price,0,',','.') }}
                    </p>

                    <p class="mb-2">
                        <strong>Status Pembayaran:</strong>

                        @if($order->payment_status == 'paid')

                            <span class="badge bg-success">
                                Sudah Dibayar
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Belum Dibayar
                            </span>

                        @endif

                    </p>

                    <ul>

                        @foreach($order->items as $item)

                            <li>
                                {{ $item->product->name }}
                                ({{ $item->qty }} pcs)
                            </li>

                        @endforeach

                    </ul>

                </div>

            @empty

                <div class="alert alert-info">
                    Belum ada pesanan masuk.
                </div>

            @endforelse

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <strong>
                Galeri Produk
            </strong>

        </div>

        <div class="card-body">

            <div class="row">

                @foreach($produkTerbaru->take(3) as $produk)

                    <div class="col-md-4 mb-3">

                        <div class="card border-0 shadow-sm">

                            @if($produk->image)

                                <img
                                    src="{{ asset('storage/'.$produk->image) }}"
                                    class="card-img-top"
                                    style="height:220px;object-fit:contain;background:#fff;">

                            @else

                                <div
                                    style="
                                        height:220px;
                                        background:#f3f4f6;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        font-size:50px;
                                    ">
                                    🌷
                                </div>

                            @endif

                            <div class="card-body text-center">

                                <strong>
                                    {{ $produk->name }}
                                </strong>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('salesChart');

if(ctx)
{
    new Chart(ctx, {

        type: 'line',

        data: {

            labels: @json($salesLabels),

            datasets: [{

                label: 'Penjualan',

                data: @json($salesData),

                borderWidth: 3,

                tension: 0.4,

                fill: true

            }]
        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            scales: {

                y: {

                    beginAtZero: true

                }

            }

        }

    });
}

</script>

@endsection