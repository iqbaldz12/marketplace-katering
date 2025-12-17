@extends('merchant.layouts.app')

@section('title', 'Edit Profil Merchant')

@section('content')
    <h2 class="mb-3">Edit Profil Merchant</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('merchant.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Perusahaan</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $merchant->company_name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="address" class="form-control" rows="2" required>{{ old('address', $merchant->address) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Kontak</label>
            <input type="text" name="contact" class="form-control" value="{{ old('contact', $merchant->contact) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $merchant->description) }}</textarea>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-danger">Simpan Profil</button>
        </div>
    </form>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>