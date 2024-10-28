@extends('layouts.app-admin')

@section('content')

<main class="content px-3 py-2">
    <div class="container-fluid">
        @include('promos.form', ['title' => 'Tambah Promo', 'route' => route('promos.store')])

    </div>
</main>
@endsection