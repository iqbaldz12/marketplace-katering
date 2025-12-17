@extends('customer.layouts.app')

@section('title', 'Hasil Pencarian Katering')

@section('content')
<h2 class="mb-4">Hasil Pencarian Katering</h2>

@if($merchants->count())
    @foreach($merchants as $merchant)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $merchant->name }}</h5>
                <p><strong>Alamat:</strong> {{ $merchant->address }}</p>
                <p><strong>Kontak:</strong> {{ $merchant->contact }}</p>

                <h6>Menu:</h6>
                @if($merchant->menus->count())
                    <ul>
                        @foreach($merchant->menus as $menu)
                            <li>{{ $menu->name }} ({{ $menu->category }}) - Rp {{ number_format($menu->price,0,',','.') }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">Tidak ada menu tersedia.</p>
                @endif
            </div>
        </div>
    @endforeach
@else
    <p class="text-muted">Tidak ada katering yang sesuai dengan kriteria pencarian.</p>
@endif

<a href="{{ route('customer.katering') }}" class="btn btn-secondary mt-3">Kembali ke Form Pencarian</a>
@endsection
