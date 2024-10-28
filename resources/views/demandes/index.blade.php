@extends('layouts.app-demande')

@section('content')
<div class="container">
  <br>

 <form method="GET" action="{{ route('demandes.mesdemandes') }}" class="search-form">
            <div class="form-row align-items-center">
                <div class="col-auto flex-grow-1">
                   <select name="etat" class="form-control custom-select">
    <option value="">All States</option>
    <option value="Onhold" {{ request('etat') == 'Onhold' ? 'selected' : '' }}>On hold</option>
    <option value="Accepted" {{ request('etat') == 'Accepted' ? 'selected' : '' }}>Accepted</option>
    <option value="Refused" {{ request('etat') == 'Refused' ? 'selected' : '' }}>Refused</option>
</select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn" style="background-color: #2aa14b; color: white;">Search</button>
                </div>
            </div>
        </form>
<br>
<div class="row">
    @if($demandes->isEmpty())
        <p>No demands found for your association.</p>
    @else
        @foreach($demandes as $demande)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"></h5>
                </div>
                <div class="card-body">
                    <p><strong>Product:</strong> {{ $demande->produit }}</p>
                    <p><strong>Quantity:</strong> {{ $demande->quantite }}</p>
                    <p><strong>Date of collection:</strong> {{ $demande->date_collecte }}</p>
                    <p><strong>State:</strong> {{ $demande->etat }}</p>
                </div>
  <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('demandes.edit', $demande->id) }}" class="btn" style="background-color: #CB6D51; color: white;">Edit</a>
                    <form action="{{ route('demandes.destroy', $demande->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" style="background-color: #2aa14b; color: white;">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    @endif
    </div>

  <div class="custom-pagination d-flex justify-content-between align-items-center mt-4">
        @if ($demandes->onFirstPage())
            <span class="disabled">&laquo; Previous</span>
        @else
            <a href="{{ $demandes->previousPageUrl() }}">&laquo; Previous</a>
        @endif

        <div class="pagination-info">
            Showing {{ $demandes->firstItem() }} to {{ $demandes->lastItem() }} of {{ $demandes->total() }} results
        </div>

        <div class="pagination-nav">
            @if($demandes->currentPage() > 1)
                <a href="{{ $demandes->url(1) }}" class="{{ $demandes->currentPage() == 1 ? 'active' : '' }}">1</a>
            @endif

            @if($demandes->currentPage() > 3)
                <span class="dots">...</span>
            @endif

            @foreach(range(max(2, $demandes->currentPage() - 1), min($demandes->lastPage() - 1, $demandes->currentPage() + 1)) as $page)
                <a href="{{ $demandes->url($page) }}" class="{{ $demandes->currentPage() == $page ? 'active' : '' }}">{{ $page }}</a>
            @endforeach

            @if($demandes->currentPage() < $demandes->lastPage() - 2)
                <span class="dots">...</span>
            @endif

            @if($demandes->currentPage() < $demandes->lastPage())
                <a href="{{ $demandes->url($demandes->lastPage()) }}" class="{{ $demandes->currentPage() == $demandes->lastPage() ? 'active' : '' }}">{{ $demandes->lastPage() }}</a>
            @endif
        </div>

        @if ($demandes->hasMorePages())
            <a href="{{ $demandes->nextPageUrl() }}">Next &raquo;</a>
        @else
            <span class="disabled">Next &raquo;</span>
        @endif
    </div>
</div>

<style>
.custom-pagination {
    font-size: 14px;
}

.custom-pagination a, .custom-pagination span {
    padding: 5px 10px;
    margin: 0 2px;
    border: 1px solid #ddd;
    color: #333;
    text-decoration: none;
}

.custom-pagination a:hover {
    background-color: #f5f5f5;
}

.custom-pagination .active {
    background-color: #CB6D51;
    color: white;
    border-color: #CB6D51;
}

.custom-pagination .disabled {
    color: #aaa;
    cursor: not-allowed;
}

.custom-pagination .dots {
    border: none;
}

.pagination-nav {
    display: flex;
    align-items: center;
}

.pagination-info {
    margin: 0 15px;
}
.search-container {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.search-form {
    display: flex;
    justify-content: center;
}

.form-row {
    display: flex;
    width: 100%;
    max-width: 600px;
}

.custom-select {
    height: 38px;
    border-radius: 4px 0 0 4px;
    border-right: none;
}

.btn-primary {
    border-radius: 0 4px 4px 0;
}

@media (max-width: 576px) {
    .form-row {
        flex-direction: column;
    }
    .custom-select {
        border-radius: 4px;
        border-right: 1px solid #ced4da;
        margin-bottom: 10px;
    }
    .btn-primary {
        border-radius: 4px;
        width: 100%;
    }
}
</style>
@endsection