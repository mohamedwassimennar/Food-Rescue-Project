@extends('layouts.app-admin')

@section('content')
<div class="mb-3">
    <h4>Admin Dashboard</h4>
</div>
<div class="row">
    <div class="col-12 col-md-6 d-flex">
        <h2>Welcome Back, {{ Auth::user()->name }}</h2>
    </div>

    <div class="container">

        <div class="card">
            <div class="card-header">
                <h1 class="my-4">Stock Details</h1>
            </div>
            <div class="card-body">
                <h5 class="card-title">Food: {{ $stock->food }}</h5>
                <p class="card-text"><strong>Expiration Date:</strong> {{ $stock->expiration_date }}</p>
                <p class="card-text"><strong>Quantity:</strong> {{ $stock->quantity }}</p>
                <p class="card-text"><strong>Location:</strong> {{ $stock->location }}</p>
                <p class="card-text"><strong>Category:</strong> {{ $stock->category->type ?? 'No Category' }}</p>
            </div>
        </div>

        <a href="{{ route('stockss.index') }}" class="btn btn-secondary my-4">Back to Stocks List</a>
    </div>
</div>

@endsection
