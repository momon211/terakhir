@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2>Data Kategori</h2>

    <a href="{{ route('categories.create') }}"
       class="btn btn-success">
        + Tambah Kategori
    </a>

</div>



<div class="card shadow">

    <div class="card-body">

        <table class="table table-bordered">

            <thead>

                <tr>
                    <th width="60">No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th width="200">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $category->nama_kategori }}
                        </td>

                        <td>
                            {{ $category->deskripsi }}
                        </td>

                        <td>

                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Hapus kategori ini?')"
                                    class="btn btn-danger btn-sm">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">
                            Belum ada data kategori.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection