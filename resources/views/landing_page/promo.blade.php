@extends('layouts.app-home')

@section('content')

<div class="container" id="coffee">
    <h2 class="promo-heading mt-4">Promo</h2>
    <div class="row" style="margin-top: 30px;">
        @foreach($promos as $promo)
        <div class="col-md-3 py-0 py-md-0">
            <div class="card border-0">
                <img src="{{ asset($promo->gambar_promo) }}" alt="{{ $promo->nama_promo }}">
                <div class="card-body">
                    <h3 class="menu-coffee">{{ $promo->nama_promo }}</h3>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection