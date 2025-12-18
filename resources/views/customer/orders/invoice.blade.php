@extends('layouts.app')

@section('title', 'Invoice Pesanan')

@section('content')
<div class="container mt-5">
    <h2>Invoice Pesanan #{{ $order->id }}</h2>
    <p>Merchant: {{ $order->merchant->name }}</p>
    <p>Status: {{ ucfirst($order->status) }}</p>
    <p>Tanggal Pemesanan: {{ $order->created_at->format('d/m/Y H:i') }}</p>

    <h4>Daftar Item</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Menu</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->menu->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-end"><strong>Total</strong></td>
                <td><strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
