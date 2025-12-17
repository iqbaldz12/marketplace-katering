@extends('merchant.layouts.app')
@section('title', 'Daftar Menu Merchant')
@section('content')

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-3">Daftar Menu</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('merchant.menus.create') }}" class="btn btn-danger mb-3">Tambah Menu</a>

        @if (count($menus))
            <table class="table table-bordered table-hover bg-white shadow-sm">
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Menu</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $index => $menu)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($menu->image)
                                    <img src="{{ asset('storage/menu_image/' . $menu->image) }}" width="60"
                                        class="rounded">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                            </td>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->category }}</td>
                            <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                            <td>{{ $menu->description }}</td>
                            <td>
                                <a href="{{ route('merchant.menus.edit', $menu->id) }}"
                                    class="btn btn-sm btn-primary mb-1">Edit</a>
                                <form action="{{ route('merchant.menus.delete', $menu->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin hapus menu?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">Belum ada menu.</p>
        @endif

        <a href="{{ route('merchant.dashboard') }}" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

@endsection
