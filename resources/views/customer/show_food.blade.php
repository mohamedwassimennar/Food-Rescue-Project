@extends('layouts.app-customer')

@section('content')
<div class="mt-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('storage/' . $food->image) }}"
                        alt="{{ $food->judul }}">
                    <div class="card-body">
                        <h1 class="card-title">{{ $food->judul }}</h1>
                        <p class="card-text">{{ $food->isi }}</p>
                        <p class="text-muted">Ditulis oleh {{ $food->penulis }} pada {{ $food->hari_buat }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection