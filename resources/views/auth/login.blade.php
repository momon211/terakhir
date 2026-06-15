<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User - Toko Bunga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="login-card">

    <div class="logo">
        🌸
    </div>

    <h3 class="title">
        Login User
    </h3>

    <p class="subtitle">
        Selamat datang di Toko Bunga
    </p>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    @if($errors->any())

        <div class="alert alert-danger">

            @foreach($errors->all() as $error)

                <div>{{ $error }}</div>

            @endforeach

        </div>

    @endif

    <form action="{{ route('login') }}" method="POST">

        @csrf

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

        <div class="mb-4">

            <label class="form-label">
                Password
            </label>

            <input
                type="password"
                name="password"
                class="form-control"
                required>

        </div>

        <button type="submit" class="btn-login">
            Login
        </button>

    </form>

  <div class="text-center mt-3">

    Belum punya akun?

    <a href="{{ route('register') }}">
        Register
    </a>

</div>

<div class="text-center mt-2">

    <a href="{{ route('admin.login') }}"
       class="btn btn-dark w-100">
        Login Sebagai Admin
    </a>

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

        .login-card{
            width:420px;
            background:white;
            border:none;
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
            font-weight:700;
            color:#198754;
            margin-bottom:5px;
        }

        .subtitle{
            text-align:center;
            color:#888;
            margin-bottom:25px;
        }

        .form-control{
            border-radius:12px;
            padding:12px;
        }

        .btn-login{
            background:#198754;
            border:none;
            border-radius:12px;
            padding:12px;
            width:100%;
            color:white;
            font-weight:600;
        }

        .btn-login:hover{
            background:#157347;
        }

    </style>

</body>
</html>