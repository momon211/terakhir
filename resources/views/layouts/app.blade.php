<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Toko Bunga Florist' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

@auth

<div class="sidebar">

    <div class="brand">
        🌷 Toko Bunga
    </div>

    <div class="menu-title">
        Menu
    </div>

    <ul class="nav flex-column">

        @if(auth()->user()->role === 'admin')

            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    📊 Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('categories.index') }}"
                   class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                    📂 Kategori
                </a>
            </li>

            <li>
                <a href="{{ route('products.index') }}"
                   class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    🌸 Produk
                </a>
            </li>

            <li>
                <a href="{{ route('admin.orders.index') }}"
                   class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    📦 Pesanan Masuk
                </a>
            </li>

        @else

            <li>
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    📊 Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('catalog') }}"
                   class="nav-link {{ request()->routeIs('catalog') ? 'active' : '' }}">
                    🏪 Lihat Toko
                </a>
            </li>

            <li>
                <a href="{{ route('orders') }}"
                   class="nav-link {{ request()->routeIs('orders') ? 'active' : '' }}">
                    📦 Pesanan Saya
                </a>
            </li>

        @endif

    </ul>

    <div class="user-box">

        <div class="user-profile">

            <div class="avatar">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>

            <div>

                <div class="fw-bold">
                    {{ auth()->user()->name }}
                </div>

                <small class="text-muted">
                    {{ ucfirst(auth()->user()->role) }}
                </small>

            </div>

        </div>

        <form action="{{ route('logout') }}"
              method="POST"
              class="mt-3">

            @csrf

            <button class="btn btn-danger w-100">
                Logout
            </button>

        </form>

    </div>

</div>

@endauth

@if(session('success'))

<div id="successToast">

    <div class="toast-custom">

        <div class="p-3">
            ✅ {{ session('success') }}
        </div>

        <div class="toast-progress"></div>

    </div>

</div>

@endif

<div class="content">

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>

setTimeout(() => {

    const toast = document.getElementById('successToast');

    if(toast)
    {
        toast.remove();
    }

}, 3000);

</script>

<style>

  body{
    background:#edf7f0;
    font-family:'Segoe UI',sans-serif;
}
        .sidebar{
            position:fixed;
            top:0;
            left:0;
            width:250px;
            height:100vh;
            background:white;
            border-right:1px solid #7820c0;
            padding:20px;
            z-index:999;
        }

        .brand{
            font-size:22px;
            font-weight:700;
            color:#198754;
            margin-bottom:30px;
        }

        .menu-title{
            font-size:12px;
            color:#9ca3af;
            text-transform:uppercase;
            margin-bottom:10px;
        }

        .sidebar .nav-link{
            color:#374151;
            border-radius:12px;
            padding:12px 15px;
            margin-bottom:8px;
            transition:.3s;
        }

        .sidebar .nav-link:hover{
            background:#d1fae5;
            color:#198754;
        }

        .sidebar .nav-link.active{
            background:#198754;
            color:white;
            font-weight:600;
        }

        .content{
            margin-left:250px;
            padding:30px;
        }

        .card{
            border:none;
            border-radius:18px;
        }

        .user-box{
            position:absolute;
            left:20px;
            right:20px;
            bottom:20px;
        }

        .user-profile{
            background:#f9fafb;
            border-radius:15px;
            padding:12px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .avatar{
            width:40px;
            height:40px;
            border-radius:50%;
            background:#198754;
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:bold;
        }

        #successToast{
            position:fixed;
            top:20px;
            right:20px;
            z-index:99999;
        }

        .toast-custom{
            background:#198754;
            color:white;
            border-radius:15px;
            min-width:320px;
            overflow:hidden;
            box-shadow:0 10px 25px rgba(0,0,0,.15);
        }

        .toast-progress{
            height:4px;
            background:white;
            animation:progressBar 3s linear forwards;
        }

        @keyframes progressBar{
            from{
                width:100%;
            }
            to{
                width:0%;
            }
        }

    </style>

</body>
</html>