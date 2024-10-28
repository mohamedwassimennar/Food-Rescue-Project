@extends('layouts.app-admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center text-primary">Food List</h1>

    <div class="mb-4 text-center">
        <a href="{{ route('food.export.excel') }}" class="btn btn-success">Export to Excel</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(isset($food) && $food->count() > 0)
        <div class="row">
            @foreach($food as $key => $item)
                <div class="col-md-4 mb-4">
                    <div class="card border-primary shadow-sm">
                        <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}"
                            data-toggle="modal" data-target="#nutrientsModal"
                            data-nutrients="{{ json_encode(['Calories' => $item->calories, 'Fats' => $item->fats, 'Carbs' => $item->carbs, 'Proteins' => $item->proteins]) }}"
                            style="cursor: pointer;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $item->name }}</h5>
                            <p class="card-text"><strong>Description:</strong> {{ $item->description }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('adminEdit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.food.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this food item?')">Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $food->links('vendor.pagination.custom') }}
        </div>
    @else
        <p class="text-center">No food items found.</p>
    @endif
</div>

<div class="modal fade" id="nutrientsModal" tabindex="-1" role="dialog" aria-labelledby="nutrientsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nutrientsModalLabel">Nutrients Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <canvas id="nutrientsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var nutrientsChart;

        $('#nutrientsModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var nutrients = button.data('nutrients');
            delete nutrients.Calories;

            var ctx = document.getElementById('nutrientsChart').getContext('2d');

            if (nutrientsChart) {
                nutrientsChart.destroy();
            }

            nutrientsChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: Object.keys(nutrients),
                    datasets: [{
                        label: 'Nutrients',
                        data: Object.values(nutrients),
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Nutrients Distribution'
                        }
                    }
                }
            });
        });
    });
</script>
@endsection
