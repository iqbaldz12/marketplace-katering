@extends('merchant.layouts.app')

@section('title', 'Invoice Order')

@section('content')
<h2 class="mb-4">Invoice Order #{{ $order->id }}</h2>

<div class="card mb-3">
    <div class="card-body">
        <p><strong>Customer:</strong> {{ $order->customer->name ?? 'Customer' }}</p>
        <p><strong>Alamat:</strong> {{ $order->customer->address ?? '-' }}</p>
        <p><strong>Kontak:</strong> {{ $order->customer->contact ?? '-' }}</p>
        <p><strong>Tanggal Kirim:</strong> {{ \Carbon\Carbon::parse($order->tanggal_kirim)->format('d M Y') }}</p>
        <p><strong>Status:</strong> {{ $order->status }}</p>
    </div>
</div>

<h4>Detail Pesanan</h4>
<table class="table table-bordered bg-white shadow-sm">
    <thead class="table-danger">
        <tr>
            <th>No</th>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->menu->name ?? '-' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->menu->price ?? 0,0,',','.') }}</td>
                <td>Rp {{ number_format(($item->menu->price ?? 0) * $item->quantity,0,',','.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<p class="text-end"><strong>Total: Rp {{ number_format($order->total,0,',','.') }}</strong></p>

<a href="{{ route('merchant.orders') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Order</a>
@endsection
