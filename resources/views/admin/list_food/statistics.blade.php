@extends('layouts.app-admin')

@section('content')

<div>
    <h2>Food Statistics</h2>
    <p>Most Caloric Foods</p>
    <div>
        <canvas id="topFoodsChart" style="width: 150px; height: 30px;"></canvas>
    </div>

    <div style="display: flex; align-items: center;">
        <div style="flex: 1; text-align: center;">
            <canvas id="totalFoodItemsChart" width="150" height="30"></canvas>
            <p>Total Food Items: {{ $totalFoodItems }}</p>
        </div>
        <div style="border-left: 1px solid #ccc; height: 100%; margin: 0 20px;"></div>
        <div style="flex: 1; text-align: center;">
            <canvas id="averageCaloriesChart" width="150" height="30"></canvas>
            <p>Average Calories: {{ $averageCalories }}</p>
        </div>
    </div>

</div>

<div>
    <h2>Restaurant Statistics</h2>
    <div style="display: flex; align-items: center;">
        <div style="flex: 1; text-align: center;">
            <canvas id="totalRestaurantsChart" width="400" height="200"></canvas>
            <p>Total Restaurants: {{ $totalRestaurants }}</p>
        </div>
        <div style="border-left: 1px solid #ccc; height: 100%; margin: 0 20px;"></div>
        <div style="flex: 1; text-align: center;">
            <canvas id="averageOpeningHoursChart" width="400" height="200"></canvas>
            <p>Average Opening Hours: {{ $averageOpeningHours }}</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx1 = document.getElementById('totalRestaurantsChart').getContext('2d');
    var totalRestaurantsChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Total Restaurants'],
            datasets: [{
                label: 'Total Restaurants',
                data: [{{ $totalRestaurants }}],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctx2 = document.getElementById('averageOpeningHoursChart').getContext('2d');
    var averageOpeningHoursChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Average Opening Hours'],
            datasets: [{
                label: 'Average Opening Hours',
                data: [{{ $averageOpeningHours }}],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctx3 = document.getElementById('totalFoodItemsChart').getContext('2d');
    var totalFoodItemsChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['Total Food Items'],
            datasets: [{
                label: 'Total Food Items',
                data: [{{ $totalFoodItems }}],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctx4 = document.getElementById('averageCaloriesChart').getContext('2d');
    var averageCaloriesChart = new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: ['Average Calories'],
            datasets: [{
                label: 'Average Calories',
                data: [{{ $averageCalories }}],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctx5 = document.getElementById('topFoodsChart').getContext('2d');
    var topFoodsChart = new Chart(ctx5, {
        type: 'bar',
        data: {
            labels: [
                @foreach($allFoods as $food)
                    '{{ $food->name }}',
                @endforeach
            ],
            datasets: [{
                label: 'Calories',
                data: [
                    @foreach($allFoods as $food)
                        {{ $food->calories }},
                    @endforeach
                ],
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
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
