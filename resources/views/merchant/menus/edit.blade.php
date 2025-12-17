<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-3">Edit Menu</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('merchant.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Menu</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $menu->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="category" class="form-control" value="{{ old('category', $menu->category) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ old('price', $menu->price) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $menu->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar (opsional)</label>
            @if($menu->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/menu_image/'.$menu->image) }}" width="100" class="rounded">
                </div>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-danger">Update Menu</button>
        </div>
    </form>

    <a href="{{ route('merchant.menus') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
