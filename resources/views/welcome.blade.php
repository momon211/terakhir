<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Bunga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="home-card">

    <div class="logo">
        🌸
    </div>

    <h2 class="fw-bold text-success">
        Toko Bunga
    </h2>

    <p class="text-muted mb-4">
        Sistem Manajemen Toko Bunga
    </p>

    <a href="{{ route('register') }}"
       class="btn btn-success btn-custom">
        Registrasi
    </a>

    <a href="{{ route('login') }}"
       class="btn btn-outline-success btn-custom">
        Login User
    </a>

   <a href="{{ route('admin.login') }}"
       class="btn btn-dark btn-custom">
        Login Admin
    </a>

</div>

 <style>

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#d8f5e5,#f8fcfa);
            font-family:'Segoe UI',sans-serif;
        }

        .home-card{
            width:500px;
            background:white;
            border-radius:25px;
            padding:40px;
            text-align:center;
            box-shadow:0 10px 30px rgba(0,0,0,.08);
        }

        .logo{
            font-size:70px;
            margin-bottom:10px;
        }

        .btn-custom{
            width:100%;
            padding:12px;
            border-radius:12px;
            margin-bottom:12px;
            font-weight:600;
        }

    </style>
    
</body>
</html>