@extends('restaurant.dashboard')

@section('content')
    <h2 class="mb-4">Feedbacks List</h2>

    <div class="list-group mb-4">
        @foreach($feedbacks as $feedback)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <strong>Feedback for {{ $feedback->association_nom }}</strong><br>
                    <span>Note: {{ $feedback->note }}</span><br>
                    <span>Comments: {{ $feedback->comments }}</span>
                </div>

                <div>
                    <!-- Update Button -->
                    <button type="button" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editFeedbackModal{{$feedback->id}}">
                        Edit
                    </button>

                    <!-- Delete Button -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$feedback->id}}">
                        Delete
                    </button>
                </div>
            </div>

            <!-- Edit Modal -->
            <div class="modal fade" id="editFeedbackModal{{$feedback->id}}" tabindex="-1" aria-labelledby="editFeedbackModalLabel{{$feedback->id}}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editFeedbackModalLabel{{$feedback->id}}">Edit Feedback for {{ $feedback->association_nom }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('feedbacks.update', $feedback->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="association_id" value="{{ $feedback->association_id }}">
                                <div class="mb-3">
                                    <label for="note" class="form-label">Rating (1-5)</label>
                                    <input type="number" name="note" class="form-control" min="1" max="5" value="{{ $feedback->note }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="comments" class="form-label">Comments</label>
                                    <textarea name="comments" class="form-control" rows="4" required>{{ $feedback->comments }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Feedback</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirmation Delete Modal -->
            <div class="modal fade" id="confirmDeleteModal{{$feedback->id}}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{$feedback->id}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel{{$feedback->id}}">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this feedback?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="mb-4">List of Associations</h2>
    <ul class="list-group">
        @foreach($associations as $association)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $association->nom }}
                <button type="button" class="btn btn-success btn-sm" style="border-radius: 0.5rem;" 
                        data-bs-toggle="modal" 
                        data-bs-target="#feedbackModal{{$association->id}}">
                    Give Feedback
                </button>
            </li>

            <!-- Modal for submitting feedback -->
            <div class="modal fade" id="feedbackModal{{$association->id}}" tabindex="-1" aria-labelledby="feedbackModalLabel{{$association->id}}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="feedbackModalLabel{{$association->id}}">Submit Feedback for {{ $association->nom }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('feedbacks.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="association_id" value="{{ $association->id }}">
                                <div class="mb-3">
                                    <label for="note" class="form-label">Rating (1-5)</label>
                                    <input type="number" name="note" class="form-control" min="1" max="5" required>
                                </div>
                                <div class="mb-3">
                                    <label for="comments" class="form-label">Comments</label>
                                    <textarea name="comments" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit Feedback</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </ul>
@endsection





