@extends('merchant.layouts.app')

@section('title', 'Dashboard Merchant')

@section('content')
<h2 class="mb-4">Dashboard Merchant</h2>

<div class="row">
    <!-- Profil Merchant -->
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                Profil Merchant
            </div>
            <div class="card-body">
                <p><strong>Nama Perusahaan:</strong> {{ $merchant->company_name }}</p>
                <p><strong>Alamat:</strong> {{ $merchant->address }}</p>
                <p><strong>Kontak:</strong> {{ $merchant->contact }}</p>
                <p><strong>Deskripsi:</strong> {{ $merchant->description ?? '-' }}</p>
                <a href="{{ route('merchant.profile.edit') }}" class="btn btn-danger btn-sm mt-2">Edit Profil</a>
            </div>
        </div>
    </div>

    <!-- Ringkasan Menu -->
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                Menu
            </div>
            <div class="card-body">
                <p>Total Menu: {{ $merchant->menus()->count() }}</p>
                <a href="{{ route('merchant.menus') }}" class="btn btn-danger btn-sm mt-2">Lihat Daftar Menu</a>
            </div>
        </div>
    </div>

    <!-- Ringkasan Orders -->
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                Orders Terbaru
            </div>
            <div class="card-body">
                @if($orders->count())
                    <ul class="list-group list-group-flush">
                        @foreach($orders as $order)
                            <li class="list-group-item">
                                <strong>#{{ $order->id }}</strong> - {{ $order->customer->name ?? 'Customer' }}
                                <br>
                                Tanggal: {{ \Carbon\Carbon::parse($order->tanggal_kirim)->format('d M Y') }}
                                <br>
                                Total: Rp {{ number_format($order->total,0,',','.') }}
                                <br>
                                Status: <span class="badge bg-secondary">{{ $order->status }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('merchant.orders') }}" class="btn btn-danger btn-sm mt-2">Lihat Semua Orders</a>
                @else
                    <p class="text-muted">Belum ada order.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>