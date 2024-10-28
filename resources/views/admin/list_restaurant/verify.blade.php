@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container mt-5 card card-body">
        <div class="container mt-4">
            <h2>Verify Restaurant Account Data</h2>
            @if(isset($restaurants) && $restaurants->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Restaurant Name</th>
                            <th>Contact</th>
                            <th>Owner Name</th>
                            <th>Cuisine Type</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($restaurants as $restaurant)
                        <tr>
                            <td>{{ $restaurant->name }}</td>
                            <td>{{ $restaurant->contact }}</td>
                            <td>{{ $restaurant->user->name }}</td>
                            <td>{{ $restaurant->cuisine_type }}</td>
                            <td>{{ $restaurant->address }}</td>
                            <td>{{ $restaurant->status ?? 'Pending' }}</td>
                            <td>
                                <form action="{{ route('restaurant.accept', $restaurant->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">Accept</button>
                                </form>
                                <form action="{{ route('restaurant.destroy', $restaurant->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No restaurants found.</p>
            @endif
        </div>
    </div>
</main>
@endsection