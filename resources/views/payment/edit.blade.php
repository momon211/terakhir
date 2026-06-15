@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-warning">

                    <h4 class="mb-0">

                        ✏ Edit Akun Pembayaran

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
                        action="{{ route('payment.update') }}"
                        method="POST">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Lengkap

                            </label>

                            <input
                                type="text"
                                name="full_name"
                                class="form-control"
                                value="{{ old('full_name', $paymentAccount->full_name) }}"
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

                                <option value="BRI"
                                    {{ $paymentAccount->bank == 'BRI' ? 'selected' : '' }}>

                                    BRI

                                </option>

                                <option value="BCA"
                                    {{ $paymentAccount->bank == 'BCA' ? 'selected' : '' }}>

                                    BCA

                                </option>

                                <option value="MANDIRI"
                                    {{ $paymentAccount->bank == 'MANDIRI' ? 'selected' : '' }}>

                                    MANDIRI

                                </option>

                                <option value="BSI"
                                    {{ $paymentAccount->bank == 'BSI' ? 'selected' : '' }}>

                                    BSI

                                </option>

                                <option value="BNI"
                                    {{ $paymentAccount->bank == 'BNI' ? 'selected' : '' }}>

                                    BNI

                                </option>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Nomor Rekening

                            </label>

                            <input
                                type="text"
                                name="account_number"
                                class="form-control"
                                value="{{ old('account_number', $paymentAccount->account_number) }}"
                                required>

                        </div>

                        <div class="d-grid gap-2">

                            <button
                                type="submit"
                                class="btn btn-warning">

                                💾 Simpan Perubahan

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