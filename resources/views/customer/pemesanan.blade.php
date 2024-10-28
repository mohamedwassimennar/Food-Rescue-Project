@extends('layouts.app-customer')

@section('content')
<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="container mt-5">
            <h2 class="mb-4">Notifications</h2>
            <div class="row">
                @php
                    $notifications = App\Models\Notification::with('evenementCollecte')->get();
                @endphp

                @foreach($notifications as $notification)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-light">
                        <div class="card-body">
                            <h5 class="card-title">{{ $notification->type }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                {{ \Carbon\Carbon::parse($notification->date_heure)->format('d/m/Y H:i') }}
                            </h6>
                            <p class="card-text">{{ $notification->message }}</p>
                            <p class="card-text"><strong>Status:</strong> {{ $notification->statut }}</p>
                            <p class="card-text"><strong>Collection Event:</strong> {{ $notification->evenementCollecte->nom ?? 'N/A' }}</p>
                            <a href="{{ route('notification.qrcode', $notification->id) }}" class="btn btn-info btn-sm">View QR Code</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($notifications->isEmpty())
                <div class="alert alert-warning mt-4" role="alert">
                    No notifications available.
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
