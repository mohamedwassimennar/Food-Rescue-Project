@extends('layouts.app-admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Food</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('adminupdate', $food->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Names:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $food->name) }}"
                required readonly>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"
                required>{{ old('description', $food->description) }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
            @if($food->image)
                <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->name }}" width="100" class="mt-2">
            @endif
        </div>

        <div class="form-group mb-3 row">
            <label for="proteins" class="col-sm-2 col-form-label">Protein (g)</label>
            <div class="col-sm-4">
                <input type="text" name="proteins" id="proteins" class="form-control"
                    value="{{ old('proteins', $food->proteins) }}" oninput="recalculateCalories()">
            </div>

            <label for="fats" class="col-sm-2 col-form-label">Fat (g)</label>
            <div class="col-sm-4">
                <input type="text" name="fats" id="fats" class="form-control" value="{{ old('fats', $food->fats) }}"
                    oninput="recalculateCalories()">
            </div>
        </div>
        <div class="form-group mb-3 row">
            <label for="carbs" class="col-sm-2 col-form-label">Carbohydrates (g)</label>
            <div class="col-sm-4">
                <input type="text" name="carbs" id="carbs" class="form-control" value="{{ old('carbs', $food->carbs) }}"
                    oninput="recalculateCalories()">
            </div>
        </div>

        <div class="form-group">
            <label for="calories">Calories Per 100g:</label>
            <input type="text" name="calories" id="calories" class="form-control"
                value="{{ old('calories', $food->calories) }}" required step="0.01">
        </div>


        <div class="form-group" hidden>
            <label for="expired_date">Expiry Date:</label>
            <input type="date" class="form-control" id="expired_date" name="expired_date"
                value="{{ old('expired_date', $food->expired_date) }}" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block my-2">Save Changes</button>
    </form>
</div>

<script>
    function recalculateCalories() {
        const fats = parseFloat(document.getElementById('fats').value) || 0;
        const carbs = parseFloat(document.getElementById('carbs').value) || 0;
        const proteins = parseFloat(document.getElementById('proteins').value) || 0;

        const calories = (fats * 9) + (carbs * 4) + (proteins * 4);
        document.getElementById('calories').value = calories.toFixed(2);
    }

</script>

@endsection