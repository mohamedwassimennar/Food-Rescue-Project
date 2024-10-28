@extends('layouts.app-customer')


@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4" style="font-weight: bold; color: #333;">Feedbacks</h1>

    @if ($feedbacks->isEmpty())
        <div class="alert alert-info text-center" style="font-size: 1.1em;">
            No feedback available for this association.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 6px 20px rgba(0,0,0,0.1);">
                <thead class="thead-light" style="background-color: #4CAF50; color: white;">
                    <tr style="text-transform: uppercase; letter-spacing: 1px;">
                        <th>ID</th>
                        <th>Note</th>
                        <th>Comments</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedbacks as $feedback)
                    <tr style="transition: background-color 0.3s;">
                        <td style="padding: 12px;">{{ $feedback->id }}</td>
                        <td style="padding: 12px;">{{ $feedback->note }}</td>
                        <td style="padding: 12px;">{{ $feedback->comments }}</td>
                        <td style="padding: 12px;">
                            <!-- Delete Button -->
                            <button class="btn btn-danger btn-sm" style="border-radius: 50px; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $feedback->id }}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal{{ $feedback->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $feedback->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background-color: #f44336; color: white;">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $feedback->id }}">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="font-size: 1.1em; color: #333;">
                                            Are you sure you want to delete this feedback?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 50px;">Cancel</button>
                                            <form action="{{ route('feedbacks.destroy', $feedback->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="border-radius: 50px;">Confirm</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        <!-- Pagination Links -->
<div class="d-flex justify-content-center mt-4">
    <ul class="pagination">
        <!-- Previous Link -->
        @if ($feedbacks->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $feedbacks->previousPageUrl() }}" style="color: #28a745;">Previous</a>
            </li>
        @endif

        <!-- Pagination Elements -->
        @foreach ($feedbacks->getUrlRange(1, $feedbacks->lastPage()) as $page => $url)
            @if ($page == $feedbacks->currentPage())
                <li class="page-item active" style="background-color: #28a745;">
                    <span class="page-link" style="border-color: #28a745; background-color: #28a745;">{{ $page }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $url }}" style="color: #28a745;">{{ $page }}</a>
                </li>
            @endif
        @endforeach

        <!-- Next Link -->
        @if ($feedbacks->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $feedbacks->nextPageUrl() }}" style="color: #28a745;">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        @endif
    </ul>
</div>

    @endif
</div>

@endsection


