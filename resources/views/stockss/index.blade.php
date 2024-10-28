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
                <h1 class="my-4">Stock Listing</h1>
            </div>
            <div class="text-end mb-3">
                <a href="{{ route('stockss.export') }}" class="btn btn-success btn-sm">Download Excel</a> <!-- Download button -->

                <a href="{{ route('stockss.create') }}" class="btn btn-info btn-sm">Add Stock</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Food</th>
                            <th>Expiration Date</th>
                            <th>Quantity</th>
                            <th>Location</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stocks as $stock)
                            <tr>
                                <td>{{ $stock->id }}</td>
                                <td>{{ $stock->food }}</td>
                                <td>{{ $stock->expiration_date }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ $stock->location }}</td>
                                <td>{{ $stock->category->type ?? 'No Category' }}</td>
                                <td>
                                    <a href="{{ route('stockss.show', $stock->id) }}" class="btn btn-info btn-sm">Details</a>
                                    <a href="{{ route('stockss.edit', $stock->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('stockss.destroy', $stock->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this stock?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Chart.js Statistics -->
                <div class="mt-5">
                    <h4>Stock Statistics by Product</h4>
                    <canvas id="stockChart"></canvas>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('stockChart').getContext('2d');
    const stockData = {
        labels: @json($stocks->pluck('food')),
        datasets: [{
            label: 'Quantity',
            data: @json($stocks->pluck('quantity')),
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
        
    };

    const stockChart = new Chart(ctx, {
        type: 'bar',
        data: stockData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
