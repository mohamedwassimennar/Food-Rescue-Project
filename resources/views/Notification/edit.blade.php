@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container mt-5 card card-body">
        <h1>Edit Notification</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('notification.update', $notification->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="type">Message Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="" disabled>Select a message type</option>
                    <option value="alerte" {{ $notification->type == 'alerte' ? 'selected' : '' }}>Alert</option>
                    <option value="rappel" {{ $notification->type == 'rappel' ? 'selected' : '' }}>Reminder</option>
                    <option value="information" {{ $notification->type == 'information' ? 'selected' : '' }}>Information</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date_heure">Date and Time</label>
                <input type="datetime-local" class="form-control" id="date_heure" name="date_heure" value="{{ \Carbon\Carbon::parse($notification->date_heure)->format('Y-m-d\TH:i') }}" required>
            </div>

            <div class="form-group">
                <label for="statut">Status</label>
                <input type="text" class="form-control" id="statut" name="statut" value="{{ $notification->statut }}" required minlength="3" maxlength="50">
                <small class="form-text text-muted">Minimum 3 characters, maximum 50 characters.</small>
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="3" required minlength="5" maxlength="500">{{ $notification->message }}</textarea>
                <small class="form-text text-muted">Minimum 5 characters, maximum 500 characters.</small>
            </div>

            <div class="form-group">
                <label for="evenement_collecte_id">Collection Event</label>
                <select class="form-control" id="evenement_collecte_id" name="evenement_collecte_id" required>
                    <option value="" disabled>Select a collection event</option>
                    @foreach($evenements as $evenement)
                        <option value="{{ $evenement->id }}" {{ $notification->evenement_collecte_id == $evenement->id ? 'selected' : '' }}>
                            {{ $evenement->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('notification.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
