<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Toko Bunga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="login-card">

    <div class="logo">
        🔐
    </div>

    <h3 class="title">
        Login Admin
    </h3>

    <p class="subtitle">
        Halaman khusus administrator
    </p>

    @if($errors->any())

        <div class="alert alert-danger">

            @foreach($errors->all() as $error)

                <div>{{ $error }}</div>

            @endforeach

        </div>

    @endif

    <form action="{{ route('admin.login.store') }}" method="POST">

        @csrf

        <div class="mb-3">

            <label>Email</label>

            <input
                type="email"
                name="email"
                class="form-control"
                required>

        </div>

        <div class="mb-4">

            <label>Password</label>

            <input
                type="password"
                name="password"
                class="form-control"
                required>

        </div>

        <button type="submit" class="btn-admin">
            Login Admin
        </button>

    </form>

</div>

<style>

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#1f2937,#111827);
            font-family:'Segoe UI',sans-serif;
        }

        .login-card{
            width:430px;
            background:white;
            border-radius:25px;
            padding:35px;
            box-shadow:0 10px 30px rgba(0,0,0,.25);
        }

        .logo{
            font-size:60px;
            text-align:center;
            margin-bottom:10px;
        }

        .title{
            text-align:center;
            font-weight:700;
            margin-bottom:5px;
        }

        .subtitle{
            text-align:center;
            color:#666;
            margin-bottom:25px;
        }

        .form-control{
            border-radius:12px;
            padding:12px;
        }

        .btn-admin{
            width:100%;
            border:none;
            border-radius:12px;
            padding:12px;
            background:#111827;
            color:white;
            font-weight:600;
        }

        .btn-admin:hover{
            background:#000;
        }

    </style>
    
</body>
</html>