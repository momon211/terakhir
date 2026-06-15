@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h4 class="mb-0">

                        💳 Registrasi Akun Pembayaran

                    </h4>

                </div>

                <div class="card-body">

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
                        action="{{ route('payment.store') }}"
                        method="POST">

                        @csrf

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Lengkap

                            </label>

                            <input
                                type="text"
                                name="full_name"
                                class="form-control"
                                value="{{ old('full_name', auth()->user()->name) }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Bank

                            </label>

                            <select
                                name="bank"
                                class="form-select"
                                required>

                                <option value="">

                                    -- Pilih Bank --

                                </option>

                                <option value="BRI">

                                    BRI

                                </option>

                                <option value="BCA">

                                    BCA

                                </option>

                                <option value="MANDIRI">

                                    MANDIRI

                                </option>

                                <option value="BSI">

                                    BSI

                                </option>

                                <option value="BNI">

                                    BNI

                                </option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                Nomor Rekening

                            </label>

                            <input
                                type="text"
                                name="account_number"
                                class="form-control"
                                value="{{ old('account_number') }}"
                                required>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">

                                PIN Pembayaran (6 Digit)

                            </label>

                            <input
                                type="password"
                                name="pin"
                                class="form-control"
                                maxlength="6"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Konfirmasi PIN

                            </label>

                            <input
                                type="password"
                                name="pin_confirmation"
                                class="form-control"
                                maxlength="6"
                                required>

                        </div>

                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-primary btn-lg">

                                💾 Simpan Akun Pembayaran

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection