@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header">
        <h3>Tambah Kategori</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('categories.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    class="form-control"
                    value="{{ old('nama_kategori') }}"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Deskripsi
                </label>

                <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="4">{{ old('deskripsi') }}</textarea>

            </div>

            <button type="submit" class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('categories.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection