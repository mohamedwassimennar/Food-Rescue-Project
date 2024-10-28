@extends('layouts.app-customer')

@section('content')

<!-- Carousel -->
<h1>Halaman Chat</h1>
<h3>User List</h3>
<ul>
    @foreach ($mitraUsers as $user)
    <li class="list-disct">
        <a class="link link-primary " href="{{ route('chat', $user->id) }}">{{ $user->nama_toko }}</a>
    </li>
    @endforeach
</ul>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

@endsection