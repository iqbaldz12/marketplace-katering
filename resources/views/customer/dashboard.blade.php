@extends('customer.layouts.app')

@section('title', 'Dashboard Customer')

@section('content')
<h2 class="mb-4">Dashboard Customer</h2>

<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">Halo, {{ $customer->name }}</h5>
        <p><strong>Alamat:</strong> {{ $customer->address ?? '-' }}</p>
        <p><strong>Kontak:</strong> {{ $customer->contact ?? '-' }}</p>
    </div>
</div>

<div class="card mb-3 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">Pesanan Terbaru</h5>
        @if($orders->count())
            <ul>
                @foreach($orders as $order)
                    <li>
                        {{ $order->merchant->name }} - Rp {{ number_format($order->total,0,',','.') }} - 
                        <a href="{{ route('customer.invoice', $order->id) }}">Lihat Invoice</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">Belum ada pesanan.</p>
        @endif
    </div>
</div>

<a href="{{ route('customer.katering') }}" class="btn btn-danger">Cari Katering</a>
@endsection
