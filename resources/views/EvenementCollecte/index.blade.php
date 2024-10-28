@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container mt-5 card card-body">
        <div class="container mt-4">
            <h1>Collection Event List</h1>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('evenement-collecte.create') }}" class="btn btn-primary mb-3">Create a New Event</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Food Type</th>
                        <th>Organizer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evenements as $evenement)
                    <tr>
                        <td>{{ $evenement->nom }}</td>
                        <td>{{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}</td>
                        <td>{{ $evenement->lieu }}</td>
                        <td>{{ $evenement->type_nourriture }}</td>
                        <td>{{ $evenement->organisateur }}</td>
                        <td>
                            <a href="{{ route('evenement-collecte.edit', $evenement->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('evenement-collecte.destroy', $evenement->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Button to download PDF -->
            <a href="{{ route('evenements.pdf') }}" class="btn btn-info mb-3">Download PDF</a>

        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
