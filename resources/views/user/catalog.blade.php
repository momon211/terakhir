@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-body">

            <h3 class="fw-bold">
                🌷 Lihat Toko
            </h3>

            <p class="text-muted mb-0">
                Pilih bunga terbaik untuk orang tersayang. Toko yang menjunjung tinggi integritas.
            </p>

        </div>

    </div>

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="row">

        @forelse($products as $product)

            <div class="col-md-4 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/'.$product->image) }}"
                            class="card-img-top"
                            style="height:250px;object-fit:cover;">

                    @else

                        <div
                            style="
                                height:250px;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                background:#f5f5f5;
                                font-size:60px;
                            ">
                            🌸
                        </div>

                    @endif

                    <div class="card-body">

                        <h5 class="fw-bold">
                            {{ $product->name }}
                        </h5>

                        <p class="text-muted">
                            {{ $product->description }}
                        </p>

                        <h5 class="fw-bold text-success">
                            Rp {{ number_format($product->price,0,',','.') }}
                        </h5>

                        <span class="badge bg-secondary mb-3">
                            Stok Tersedia : {{ $product->stock }}
                        </span>

                        <form
                            action="{{ route('order.store',$product->id) }}"
                            method="POST">

                            @csrf

                            <div class="mb-3">

                                <label class="fw-bold mb-2">
                                    Jumlah Pembelian
                                </label>

                                <div class="qty-box">

                                    <button
                                        type="button"
                                        class="btn btn-danger qty-btn"
                                        onclick="minusQty({{ $product->id }})">

                                        -

                                    </button>

                                    <input
                                        type="number"
                                        id="qty{{ $product->id }}"
                                        name="qty"
                                        value="0"
                                        min="0"
                                        class="form-control qty-input"
                                        onkeyup="checkStock({{ $product->id }}, {{ $product->stock }})"
                                        onchange="checkStock({{ $product->id }}, {{ $product->stock }})"
                                        required>

                                    <button
                                        type="button"
                                        class="btn btn-success qty-btn"
                                        onclick="plusQty({{ $product->id }}, {{ $product->stock }})">

                                        +

                                    </button>

                                </div>

                                <small
                                    id="warning{{ $product->id }}"
                                    class="text-danger d-none">

                                    Jumlah pesanan melebihi stok tersedia.

                                </small>

                            </div>

                            @if($product->stock > 0)

                                <button
                                    type="submit"
                                    id="submit{{ $product->id }}"
                                    class="btn btn-success w-100">

                                    🛒 Pesan Sekarang

                                </button>

                            @else

                                <button
                                    type="button"
                                    class="btn btn-secondary w-100"
                                    disabled>

                                    Stok Habis

                                </button>

                            @endif

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="alert alert-warning">

                    Belum ada produk tersedia.

                </div>

            </div>

        @endforelse

    </div>

</div>

<script>

function plusQty(id, stock)
{
    let qtyInput = document.getElementById('qty' + id);

    let qty = parseInt(qtyInput.value) || 0;

    qtyInput.value = qty + 1;

    checkStock(id, stock);
}

function minusQty(id)
{
    let qtyInput = document.getElementById('qty' + id);

    let qty = parseInt(qtyInput.value) || 0;

    if(qty > 0)
    {
        qtyInput.value = qty - 1;
    }

    let stock = parseInt(qtyInput.getAttribute('data-stock')) || 0;

    checkStock(id, stock);
}

function checkStock(id, stock)
{
    let qtyInput = document.getElementById('qty' + id);

    let warning = document.getElementById('warning' + id);

    let submitBtn = document.getElementById('submit' + id);

    let qty = parseInt(qtyInput.value) || 0;

    if(qty <= 0)
    {
        warning.innerHTML = 'lakukan pesanan.';
        warning.classList.remove('d-none');

        if(submitBtn)
        {
            submitBtn.disabled = true;
        }

        return;
    }

    if(qty > stock)
    {
        warning.innerHTML =
            'Jumlah pesanan melebihi stok tersedia. Stok saat ini hanya ' +
            stock +
            ' item.';

        warning.classList.remove('d-none');

        if(submitBtn)
        {
            submitBtn.disabled = true;
        }
    }
    else
    {
        warning.classList.add('d-none');

        if(submitBtn)
        {
            submitBtn.disabled = false;
        }
    }
}

document.addEventListener('DOMContentLoaded', function(){

    @foreach($products as $product)

        document
            .getElementById('qty{{ $product->id }}')
            .setAttribute('data-stock', '{{ $product->stock }}');

        checkStock(
            {{ $product->id }},
            {{ $product->stock }}
        );

    @endforeach

});

</script>

@endsection

<style>

.qty-box{
    display:flex;
    align-items:center;
    gap:8px;
}

.qty-btn{
    width:40px;
    height:40px;
    border:none;
    border-radius:8px;
    font-size:20px;
    font-weight:bold;
    color:white;
}

.qty-input{
    width:80px;
    text-align:center;
    font-weight:bold;
}

.qty-input::-webkit-outer-spin-button,
.qty-input::-webkit-inner-spin-button{
    -webkit-appearance:none;
    margin:0;
}

.qty-input{
    -moz-appearance:textfield;
}

</style>