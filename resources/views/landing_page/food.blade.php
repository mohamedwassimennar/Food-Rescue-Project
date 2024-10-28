@extends('layouts.app-home')

@section('content')
<div class="mt-5">
    <div class="container mt-5">
        <div class="row">
            @foreach($food as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($article->image) }}" class="card-img-top" alt="{{ $article->judul }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->judul }}</h5>
                        <p class="card-text">{{ Str::limit($article->isi, 100) }}</p>
                        <a href="{{ route('landing_page.show_food', $article->id) }}" class="btn btn-primary">Baca
                            Food</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

@endsection