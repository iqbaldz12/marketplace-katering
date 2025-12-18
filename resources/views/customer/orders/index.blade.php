@extends('customer.layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<h2 class="mb-4">Daftar Pesanan</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($orders->count())
    <table class="table table-bordered table-hover bg-white shadow-sm">
        <thead class="table-danger">
            <tr>
                <th>No</th>
                <th>Merchant</th>
                <th>Total</th>
                <th>Tanggal Pengiriman</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->merchant->company_name }}</td>
                    <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->tanggal_kirim)->format('d M Y') }}</td>
                    <td>
                        @if($order->status === 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($order->status === 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($order->status === 'cancelled')
                            <span class="badge bg-danger">Cancelled</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('customer.orders.invoice', $order->id) }}" class="btn btn-sm btn-primary">Lihat Invoice</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-muted">Belum ada pesanan.</p>
@endif
@endsection
