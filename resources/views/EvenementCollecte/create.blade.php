@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container mt-5 card card-body">
        <h1>Create a New Collection Event</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('evenement-collecte.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nom">Name</label>
                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom') }}" required>
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="lieu">Location</label>
                <input type="text" class="form-control @error('lieu') is-invalid @enderror" id="lieu" name="lieu" value="{{ old('lieu') }}" required>
                @error('lieu')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="type_nourriture">Type of Food</label>
                <input type="text" class="form-control @error('type_nourriture') is-invalid @enderror" id="type_nourriture" name="type_nourriture" value="{{ old('type_nourriture') }}" required>
                @error('type_nourriture')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="organisateur">Organizer</label>
                <input type="text" class="form-control @error('organisateur') is-invalid @enderror" id="organisateur" name="organisateur" value="{{ old('organisateur') }}" required>
                @error('organisateur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="{{ route('evenement-collecte.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
