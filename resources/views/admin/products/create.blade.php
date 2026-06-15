@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header">
        <h3>Tambah Produk</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('products.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label class="form-label">Kategori</label>

                <select name="category_id"
                        class="form-control"
                        required>

                    <option value="">
                        -- Pilih Kategori --
                    </option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->nama_kategori }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>

                <textarea name="description"
                          class="form-control"
                          rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>

                <input type="number"
                       name="price"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>

                <input type="number"
                       name="stock"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Produk</label>

                <input type="file"
                       name="image"
                       class="form-control"
                       accept="image/*"
                       onchange="previewImage(event)">
            </div>

            <div class="mb-3">
                <img id="preview"
                     src=""
                     width="200"
                     class="img-thumbnail d-none">
            </div>

            <button type="submit"
                    class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

<script>
function previewImage(event)
{
    const preview = document.getElementById('preview');

    preview.src = URL.createObjectURL(event.target.files[0]);

    preview.classList.remove('d-none');
}
</script>

@endsection