@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container-fluid">
        @include('promos.form', ['title' => 'Edit Promo', 'route' => route('promos.update', $promo->id),
        'method' => 'PUT'])

    </div>
</main>
@endsection