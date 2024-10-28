@extends('restaurant.dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Food List</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="text-right mb-3">
        <a href="{{ route('food.create') }}" class="btn btn-success">Add Food</a>
    </div>

    @if(isset($food) && $food->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($food as $key => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" width="200"
                                class="img-thumbnail">
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('food.edit', $item->id) }}" class="btn btn-warning me-1">Edit</a>
                                <form action="{{ route('food.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this food item?')">Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center">No food items found.</p>
    @endif
</div>
@endsection
