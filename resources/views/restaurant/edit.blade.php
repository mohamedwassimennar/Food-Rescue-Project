@extends('restaurant.dashboard')

@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <h4>Edit Restaurant</h4>
    </div>
    <div class="row">
        <div class="col-12">
            <form action="{{ route('restaurant.update', $restaurant) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Restaurant Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $restaurant->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required
                        value="{{ old('address', $restaurant->address) }}"></input>
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" class="form-control" id="contact" name="contact"
                        value="{{ old('contact', $restaurant->contact) }}" required>
                </div>

                <div class="mb-3">
                    <label for="cuisine_type" class="form-label">Cuisine Type</label>
                    <input type="text" class="form-control" id="cuisine_type" name="cuisine_type"
                        value="{{ old('cuisine_type', $restaurant->cuisine_type) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Opening Hours</label>
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="opening_time">Opening Time</label>
                        </div>
                        <div class="col-md-4">
                            <input type="time" class="form-control" id="opening_time" name="opening_time"
                                value="{{ old('opening_time', $restaurant->opening_time ? $restaurant->opening_time->format('H:i') : '') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="closing_time">Closing Time</label>
                        </div>
                        <div class="col-md-4">
                            <input type="time" class="form-control" id="closing_time" name="closing_time"
                                value="{{ old('closing_time', $restaurant->closing_time ? $restaurant->closing_time->format('H:i') : '') }}">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Restaurant</button>
            </form>
        </div>
    </div>
</div>
@endsection