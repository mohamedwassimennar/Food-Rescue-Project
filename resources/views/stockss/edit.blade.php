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
        <!-- Card Start -->
        <div class="card my-4">
            <div class="card-header">
                <h1>Edit Stock</h1>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('stockss.update', $stock->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="food" class="form-label">Food</label>
                        <input type="text" class="form-control" id="food" name="food" value="{{ old('food', $stock->food) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="expiration_date" class="form-label">Expiration Date</label>
                        <input type="date" class="form-control" id="expiration_date" name="expiration_date" value="{{ old('expiration_date', $stock->expiration_date) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $stock->quantity) }}"  min="1">
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $stock->location) }}" >
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-control" id="category_id" name="category_id" >
                            <option value="">Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ (old('category_id', $stock->category_id) == $category->id) ? 'selected' : '' }}>
                                    {{ $category->type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Stock</button>
                </form>
            </div>
        </div>
        <!-- Card End -->
    </div>
</div>
@endsection
