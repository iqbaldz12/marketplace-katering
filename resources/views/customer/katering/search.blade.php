@extends('customer.layouts.app')

@section('title', 'Cari Katering')

@section('content')
<h2 class="mb-4">Cari Katering</h2>

<form action="{{ route('customer.katering.results') }}" method="GET" class="mb-4">
    <div class="row g-3">
        <div class="col-md-5">
            <input type="text" name="location" class="form-control" placeholder="Lokasi (misal: Bandung)" value="{{ request('location') }}">
        </div>
        <div class="col-md-5">
            <input type="text" name="category" class="form-control" placeholder="Kategori makanan" value="{{ request('category') }}">
        </div>
        <div class="col-md-2">
            <button class="btn btn-danger w-100">Cari</button>
        </div>
    </div>
</form>

@if($merchants->count())
    @foreach($merchants as $merchant)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $merchant->company_name }}</h5>
                <p><strong>Alamat:</strong> {{ $merchant->address }}</p>
                <p><strong>Kontak:</strong> {{ $merchant->contact }}</p>

                <h6>Menu:</h6>
                @if($merchant->menus->count())
                    <div class="row">
                        @foreach($merchant->menus as $menu)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    @if($menu->image)
                                        <img src="{{ asset('storage/menu_images/'.$menu->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    @endif
                                    <div class="card-body">
                                        <h6 class="card-title">{{ $menu->name }}</h6>
                                        <p class="mb-1"><strong>Kategori:</strong> {{ $menu->category }}</p>
                                        <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($menu->price,0,',','.') }}</p>
                                        <p class="mb-0">{{ $menu->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Tidak ada menu tersedia.</p>
                @endif

<a href="{{ route('customer.order.form', parameters: $merchant->id) }}">Pesan Sekarang</a>
            </div>
        </div>
    @endforeach
@else
    <p class="text-muted">Tidak ada katering yang sesuai dengan kriteria pencarian.</p>
@endif
@endsection
