@extends('layouts.app-customer')

@section('content')
<div class="container">
    <h1>Faire une demande</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('demandes.store') }}" method="POST">
        @csrf
        
        <!-- Sélection de l'association -->
        <div class="form-group">
            <label for="association_id">Association</label>
            <select name="association_id" id="association_id" class="form-control" required>
                <option value="">Sélectionnez une association</option>
                @foreach($associations as $association)
                    <option value="{{ $association->id }}">{{ $association->nom }}</option>
                @endforeach
            </select>
        </div>

        <!-- Produit -->
        <div class="form-group">
            <label for="produit">Produit demandé</label>
            <input type="text" name="produit" id="produit" class="form-control" placeholder="Produit" required>
        </div>

        <!-- Quantité -->
        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" name="quantite" id="quantite" class="form-control" placeholder="Quantité" required min="1">
        </div>

        <!-- Date de collecte -->
        <div class="form-group">
            <label for="date_collecte">Date de collecte</label>
            <input type="date" name="date_collecte" id="date_collecte" class="form-control" required>
        </div>

        <!-- Soumettre -->
        <button type="submit" class="btn btn-primary">Soumettre la demande</button>
    </form>
</div>

@endsection