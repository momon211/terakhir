<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Toko Bunga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="register-card">

    <div class="logo">
        🌸
    </div>

    <h3 class="title">
        Registrasi User
    </h3>

    @if($errors->any())

        <div class="alert alert-danger">

            @foreach($errors->all() as $error)

                <div>{{ $error }}</div>

            @endforeach

        </div>

    @endif

    <form action="{{ route('register') }}" method="POST">

        @csrf

        <div class="mb-3">

            <label class="form-label">
                Nama
            </label>

            <input
                type="text"
                name="name"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Email
            </label>

            <input
                type="email"
                name="email"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Password
            </label>

            <input
                type="password"
                name="password"
                class="form-control"
                required>

        </div>

        <div class="mb-4">

            <label class="form-label">
                Konfirmasi Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                required>

        </div>

        <button type="submit" class="btn-register">
            Registrasi
        </button>

    </form>

    <div class="text-center mt-4">

        Sudah punya akun?

        <a href="{{ route('login') }}">
            Login
        </a>

    </div>

</div>

 <style>

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#d8f5e5,#f5faf7);
            font-family:'Segoe UI',sans-serif;
        }

        .register-card{
            width:450px;
            background:white;
            border-radius:25px;
            padding:35px;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
        }

        .logo{
            font-size:55px;
            text-align:center;
            margin-bottom:10px;
        }

        .title{
            text-align:center;
            color:#198754;
            font-weight:700;
            margin-bottom:25px;
        }

        .form-control{
            border-radius:12px;
            padding:12px;
        }

        .btn-register{
            width:100%;
            border:none;
            border-radius:12px;
            padding:12px;
            background:#198754;
            color:white;
            font-weight:600;
        }

    </style>

</body>
</html>