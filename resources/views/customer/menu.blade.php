@extends('layouts.app-customer')

@section('content')
<!-- Search Bar -->
<section class="header-main border-bottom bg-white">
    <div class="container-fluid">

    </div>
</section>
<p class="text " style="background-color: #004A62" text-color=""> </p>

<div class="container" id="coffee">
    <h2 class="promo-heading mt-4">Premium Taste</h2>
    <div class="row" style="margin-top: 30px;">
        <div class="row" style="margin-top: 30px;">
            @foreach($menus as $menu)
            @if($menu->kategori_menu === 'Premium Taste')
            <div class="col-md-3 py-0 py-md-0">
                <div class="card border-0">
                    <img src="{{ asset($menu->gambar_menu) }}" alt="{{ $menu->nama_menu }}">
                    <div class="card-body">
                        <h3 class="menu-coffee">{{ $menu->nama_menu }}</h3>
                        <h5 class="menu-coffee">{{ 'Rp ' . number_format($menu->harga_menu, 0, ',', '.') }}
                            <span></span>
                        </h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="menu-coffee">Stock: {{ getStockQuantity($stocks, $menu->id) }}</h5>
                            <div class="text-end">
                                <form action="{{ route('addToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <button type="submit" class="btn btn-primary">Beli</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <h2 class="promo-heading mt-4">Coffee</h2>
        <div class="row" style="margin-top: 30px;">
            @foreach($menus as $menu)
            @if($menu->kategori_menu === 'Coffee')
            <div class="col-md-3 py-0 py-md-0">
                <div class="card border-0">
                    <img src="{{ asset($menu->gambar_menu) }}" alt="{{ $menu->nama_menu }}">
                    <div class="card-body">
                        <h3 class="menu-coffee">{{ $menu->nama_menu }}</h3>
                        <h5 class="menu-coffee">{{ 'Rp ' . number_format($menu->harga_menu, 0, ',', '.') }}
                            <span></span>
                        </h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="menu-coffee">Stock: {{ getStockQuantity($stocks, $menu->id) }}</h5>
                            <div class="text-end">
                                <form action="{{ route('addToCart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                    <button type="submit" class="btn btn-primary">Beli</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <h2 class="promo-heading mt-4">Non-Coffee</h2>
        <div class="row" style="margin-top: 30px;">
            @foreach($menus as $menu)
            @if($menu->kategori_menu === 'Non-Coffee')
            <div class="col-md-3 py-0 py-md-0">
                <div class="card border-0">
                    <img src="{{ asset($menu->gambar_menu) }}" alt="{{ $menu->nama_menu }}">
                    <div class="card-body">
                        <h3 class="menu-coffee">{{ $menu->nama_menu }}</h3>
                        <h5 class="menu-coffee">{{ 'Rp ' . number_format($menu->harga_menu, 0, ',', '.') }}
                            <span></span>
                        </h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="menu-coffee">Stock: {{ getStockQuantity($stocks, $menu->id) }}</h5>
                            <div class="text-end">
                                <div class="text-end">
                                    <form action="{{ route('addToCart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <button type="submit" class="btn btn-primary">Beli</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <h2 class="promo-heading mt-4">Food</h2>
        <div class="row" style="margin-top: 30px;">
            @foreach($menus as $menu)
            @if($menu->kategori_menu === 'Food')
            <div class="col-md-3 py-0 py-md-0">
                <div class="card border-0">
                    <img src="{{ asset($menu->gambar_menu) }}" alt="{{ $menu->nama_menu }}">
                    <div class="card-body">
                        <h3 class="menu-coffee">{{ $menu->nama_menu }}</h3>
                        <h5 class="menu-coffee">{{ 'Rp ' . number_format($menu->harga_menu, 0, ',', '.') }}
                            <span></span>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="menu-coffee">Stock: {{ getStockQuantity($stocks, $menu->id) }}</h5>
                                <div class="text-end">
                                    <form action="{{ route('addToCart') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                        <button type="submit" class="btn btn-primary">Beli</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>




<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


@php
function getStockQuantity($stocks, $menuId) {
$stock = $stocks->where('menu_id', $menuId)->first();
return $stock ? $stock->quantity : 0;
}
@endphp
@endsection