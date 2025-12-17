@extends('merchant.layouts.app')

@section('title', 'Daftar Order')

@section('content')
<h2 class="mb-4">Daftar Order</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($orders->count())
    <table class="table table-bordered table-hover bg-white shadow-sm">
        <thead class="table-danger">
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>Tanggal Kirim</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->customer->name ?? 'Customer' }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->tanggal_kirim)->format('d M Y') }}</td>
                    <td>Rp {{ number_format($order->total,0,',','.') }}</td>
                    <td><span class="badge bg-secondary">{{ $order->status }}</span></td>
                    <td>
                        <a href="{{ route('merchant.orders.invoice', $order->id) }}" class="btn btn-sm btn-primary">Invoice</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-muted">Belum ada order.</p>
@endif

<a href="{{ route('merchant.dashboard') }}" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
@endsection
