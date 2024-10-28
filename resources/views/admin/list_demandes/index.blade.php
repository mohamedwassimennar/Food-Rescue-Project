@extends('layouts.app-admin')

@section('content')
<main class="content px-3 py-2">
    <div class="container mt-5 card card-body">
        <h1>List of Demands</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name Association</th> <!-- Ajout de la colonne pour l'association -->
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Date of Collection</th>
                    <th>State</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($demandes as $demande)
                <tr>
                    <td>{{ $demande->id }}</td>
                    <td>{{ $demande->association ? $demande->association->nom : 'N/A' }}</td> <!-- Afficher le nom de l'association -->
                    <td>{{ $demande->produit }}</td>
                    <td>{{ $demande->quantite }}</td>
                    <td>{{ $demande->date_collecte }}</td>
                    <td>{{ $demande->etat }}</td>
                    <td>
                       <form method="POST" action="{{ route('admin.list_demandes.update', $demande->id) }}">
                           @csrf
                           @method('PUT')
                           <select name="etat" class="form-select" onchange="this.form.submit()">
                               <option value="Onhold" {{ $demande->etat === 'Onhold' ? 'selected' : '' }}>Onhold</option>
                               <option value="Accepted" {{ $demande->etat === 'Accepted' ? 'selected' : '' }}>Accepted</option>
                               <option value="Refused" {{ $demande->etat === 'Refused' ? 'selected' : '' }}>Refused</option>
                           </select>
                       </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
@endsection
