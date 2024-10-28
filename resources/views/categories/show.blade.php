@extends('layouts.app-admin')

@section('content')
<div class="mb-3">
    <h4>Admin Dashboard</h4>
</div>

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Category: {{ $category->type }}</h5>
            </div>
            <div class="card-body">
                <p class="card-text"><strong>Description:</strong> {{ $category->description }}</p>
                
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories List</a>
            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit Category</a>
            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
