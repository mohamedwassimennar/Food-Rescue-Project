@extends('layouts.app-demande')

@section('content')
<div class="container">
    <h1 class="text-center mb-4" style="color: #4b4b4b;">Update Demands</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <form action="{{ route('demandes.update', $demande->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="produit">Product</label>
            <input type="text" name="produit" id="produit" class="form-control" value="{{ $demande->produit }}" required>
        </div>

        <div class="form-group">
            <label for="quantite">Quantity</label>
            <input type="number" name="quantite" id="quantite" class="form-control" value="{{ $demande->quantite }}" required>
        </div>

        <div class="form-group">
            <label for="date_collecte">Date of collection</label>
            <input type="date" name="date_collecte" id="date_collecte" class="form-control" value="{{ $demande->date_collecte }}" required>
        </div>

        <button type="submit" class="btn" style="background-color: #2aa14b; color: white;">Update</button>
    </form>
</div>
@endsection
