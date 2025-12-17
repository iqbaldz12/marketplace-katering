<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-3">Invoice Pesanan</h2>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <p><strong>Customer:</strong> {{ $order->customer->user->name }}</p>
            <p><strong>Alamat:</strong> {{ $order->customer->address }}</p>
            <p><strong>Kontak:</strong> {{ $order->customer->contact }}</p>
            <p><strong>Tanggal Kirim:</strong> {{ $order->tanggal_kirim }}</p>
            <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h5 class="card-title">Detail Pesanan</h5>
            <table class="table table-bordered table-hover">
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->menu->name }}</td>
                            <td>{{ $item->menu->type }}</td>
                            <td>Rp {{ number_format($item->menu->price,0,',','.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->subtotal,0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h5 class="text-end">Total: Rp {{ number_format($order->total,0,',','.') }}</h5>
        </div>
    </div>

    <a href="{{ route('merchant.dashboard') }}" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
