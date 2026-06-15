@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow mb-4">

        <div class="card-body">

            <a href="{{ route('store') }}"
               class="btn btn-secondary mb-3">

                ← Kembali ke Kategori

            </a>

            <h2 class="fw-bold text-success">

                {{ $category->nama_kategori }}

            </h2>

        </div>

    </div>

    <div class="row">

        @forelse($products as $product)

            <div class="col-md-4 mb-4">

                <div class="card shadow h-100">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            class="card-img-top"
                            style="height:250px;object-fit:cover;">

                    @endif

                    <div class="card-body">

                        <h5 class="fw-bold">

                            {{ $product->name }}

                        </h5>

                        <p class="text-muted">

                            {{ $product->description }}

                        </p>

                        <p>

                            Stok : {{ $product->stock }}

                        </p>

                        <h4 class="text-success">

                            Rp {{ number_format($product->price,0,',','.') }}

                        </h4>

                    </div>

                    <div class="card-footer bg-white">

                        <form action="{{ route('order.store',$product->id) }}"
                              method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-success w-100">

                                🛒 Pesan Sekarang

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    Tidak ada produk dalam kategori ini.

                </div>

            </div>

        @endforelse

    </div>

</div>

@endsection