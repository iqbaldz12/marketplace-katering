<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Merchant')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #dc3545;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #c82333;
        }
        .sidebar .nav-link.active {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="d-flex">

    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4 class="mb-4">Marketplace Katering</h4>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('merchant.dashboard') }}" class="nav-link {{ request()->is('merchant/dashboard') ? 'active' : '' }}">Dashboard</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('merchant.menus') }}" class="nav-link {{ request()->is('merchant/menus*') ? 'active' : '' }}">Menu</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('merchant.profile.edit') }}" class="nav-link {{ request()->is('merchant/profile') ? 'active' : '' }}">Profil</a>
            </li>
            <li class="nav-item mb-2">
                <a href="{{ route('merchant.orders') }}" class="nav-link {{ request()->is('merchant/orders*') ? 'active' : '' }}">Orders</a>
            </li>
            <li class="nav-item mt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light w-100" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4 bg-light">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
