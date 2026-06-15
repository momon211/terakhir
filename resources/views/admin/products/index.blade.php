@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2>Data Produk</h2>

    <a href="{{ route('products.create') }}"
       class="btn btn-success">
        + Tambah Produk
    </a>

</div>

<div class="card mb-4">

    <div class="card-body">

        <form method="GET"
              action="{{ route('products.index') }}">

            <div class="row">

                <div class="col-md-10">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari nama produk..."
                        value="{{ $keyword ?? '' }}">

                </div>

                <div class="col-md-2">

                    <button
                        type="submit"
                        class="btn btn-primary w-100">

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@forelse($categories as $category)

    <div class="card shadow mb-4">

        <div class="card-header bg-success text-white">

            <h4 class="mb-0">

                🌷 {{ $category->nama_kategori }}

            </h4>

        </div>

        <div class="card-body">

            @if($category->products->count())

                <div class="row">

                    @foreach($category->products as $product)

                        <div class="col-md-4 mb-4">

                            <div class="card h-100 border">

                                @if($product->image)

                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        class="card-img-top"
                                        style="height:220px;object-fit:cover;">

                                @else

                                    <div
                                        class="d-flex align-items-center justify-content-center bg-light"
                                        style="height:220px;">

                                        Tidak Ada Foto

                                    </div>

                                @endif

                                <div class="card-body">

                                    <h5 class="fw-bold">

                                        {{ $product->name }}

                                    </h5>

                                    <p class="text-muted">

                                        {{ $product->description }}

                                    </p>

                                    <p class="mb-1">

                                        <strong>Harga :</strong>

                                        Rp {{ number_format($product->price,0,',','.') }}

                                    </p>

                                    <p class="mb-0">

                                        <strong>Stok :</strong>

                                        {{ $product->stock }}

                                    </p>

                                </div>

                                <div class="card-footer bg-white">

                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-warning btn-sm">

                                        Edit

                                    </a>

                                    <form
                                        action="{{ route('products.destroy', $product->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="alert alert-warning mb-0">

                    Belum ada produk pada kategori ini.

                </div>

            @endif

        </div>

    </div>

@empty

    <div class="alert alert-warning">

        Belum ada kategori.

    </div>

@endforelse

@endsection