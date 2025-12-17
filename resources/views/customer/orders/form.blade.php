@extends('customer.layouts.app')

@section('title', 'Pesan Menu')

@section('content')
<div class="container mt-4">
    <h1>Pemesanan untuk {{ $merchant->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customer.order.submit', $merchant->id) }}" method="POST">
        @csrf

        <!-- Nama Pemesan -->
        <div class="mb-3">
            <label class="form-label">Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
        </div>

        <!-- Tanggal Pengiriman -->
        <div class="mb-3">
            <label class="form-label">Tanggal Pengiriman:</label>
            <input type="date" name="delivery_date" class="form-control" required>
        </div>

        <!-- Daftar Menu -->
        <h3 class="mt-4">Menu Tersedia:</h3>
        <div class="row">
            @foreach ($merchant->menus as $menu)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->name }}</h5>
                            <p class="card-text">Rp{{ number_format($menu->price, 0, ',', '.') }}</p>
                            <div class="mb-2">
                                <label class="form-label">Jumlah:</label>
                                <input type="number" name="jumlah[{{ $menu->id }}]" class="form-control" min="0" step="1" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary mt-3">Pesan</button>
        <a href="{{ route('customer.merchants.list') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Merchant</a>
    </form>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    