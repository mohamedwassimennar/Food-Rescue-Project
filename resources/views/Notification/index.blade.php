@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container mt-5 card card-body">
        <h1>Notification List</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('notification.create') }}" class="btn btn-primary mb-3">Create a New Notification</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Date and Time</th>
                    <th>Status</th>
                    <th>Message</th>
                    <th>Collection Event</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $notification)
                    <tr>
                        <td>{{ $notification->type }}</td>
                        <td>{{ \Carbon\Carbon::parse($notification->date_heure)->format('d/m/Y H:i') }}</td>
                        <td>{{ $notification->statut }}</td>
                        <td>{{ $notification->message }}</td>
                        <td>{{ $notification->evenementCollecte->nom ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('notification.edit', $notification->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('notification.destroy', $notification->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this notification?')">Delete</button>
                            </form>
                            <a href="{{ route('notification.qrcode', $notification->id) }}" class="btn btn-info">QR Code</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
