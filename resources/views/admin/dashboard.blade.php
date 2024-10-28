@extends('layouts.app-admin')

@section('content')
<div class="mb-3">
    <h4>Admin Dashboard</h4>
</div>
<div class="row">
    <div class="col-12 col-md-6 d-flex">
        <h2>Welcome Back, {{ Auth::user()->name }}</h2>
    </div>
</div>

@endsection