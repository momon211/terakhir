@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">

                    <h4 class="mb-0">

                        🔐 Ganti PIN Pembayaran

                    </h4>

                </div>

                <div class="card-body">

                    @if(session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif

                    @if($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                    <form
                        action="{{ route('payment.change-pin') }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">

                                PIN Lama

                            </label>

                            <input
                                type="password"
                                name="old_pin"
                                class="form-control"
                                maxlength="6"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                PIN Baru

                            </label>

                            <input
                                type="password"
                                name="new_pin"
                                class="form-control"
                                maxlength="6"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Konfirmasi PIN Baru

                            </label>

                            <input
                                type="password"
                                name="new_pin_confirmation"
                                class="form-control"
                                maxlength="6"
                                required>

                        </div>

                        <div class="d-grid gap-2">

                            <button
                                type="submit"
                                class="btn btn-dark">

                                🔐 Simpan PIN Baru

                            </button>

                            <a
                                href="{{ route('dashboard') }}"
                                class="btn btn-secondary">

                                Kembali

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection