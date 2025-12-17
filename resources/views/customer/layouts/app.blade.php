<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Marketplace Katering</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <div class="container">
        <a class="navbar-brand" href="{{ route('customer.dashboard') }}">Marketplace Katering</a>
        <div>
            <span class="text-white me-3">Halo, {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-3 mb-3">
            <div class="list-group shadow-sm">
                <a href="{{ route('customer.dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="{{ route('customer.katering') }}" class="list-group-item list-group-item-action">Cari Katering</a>
                <a href="{{ route('customer.orders') }}" class="list-group-item list-group-item-action">Daftar Pesanan</a>
                <a href="{{ route('customer.profile') }}" class="list-group-item list-group-item-action">Profil Saya</a>
            </div>
        </div>

        {{-- Konten utama --}}
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
