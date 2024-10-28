<!-- resources/views/stocks/show.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Stock</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Show Stock</h2>
        <div>
            <strong>Menu ID:</strong> {{ $stock->menu_id }}
        </div>
        <div>
            <strong>Quantity:</strong> {{ $stock->quantity }}
        </div>
        <a href="{{ route('stocks.index') }}" class="btn btn-primary mt-3">Back</a>
    </div>
</body>

</html>