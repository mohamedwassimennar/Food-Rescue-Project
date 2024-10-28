@extends('layouts.app-customer')

@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Section gauche: Profil utilisateur -->
        <div class="col-md-4 mb-4">
            <div class="card text-center card-custom">
                <div class="card-body">
                    <!-- Photo de profil -->
                    <div class="mb-4 d-flex justify-content-center">
                        @if ($profil_customer->foto)
                            <img class="rounded-circle img-fluid" 
                                 style="width: 150px; height: 150px;" 
                                 src="{{ asset('storage/'.$profil_customer->foto) }}" 
                                 alt="Photo de profil">
                        @else
                            <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" 
                                 style="width: 150px; height: 150px;">
                                <i class="bi bi-person" style="font-size: 60px; color: #6c757d;"></i>
                            </div>
                        @endif
                    </div>

                    <!-- Nom de l'utilisateur -->
                    <h4 class="card-title">{{ $profil_customer->name }}</h4>

                    <!-- Formulaire pour uploader une nouvelle photo -->
                    <form action="{{ route('customer.profil.updatePhoto', ['id' => $profil_customer->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="foto" id="foto" class="form-control-file d-none" onchange="form.submit()">
                        <button type="button" class="btn" style="background-color: #2aa14b; color: white;" onclick="document.getElementById('foto').click();">
                            Upload a new photo
                        </button>
                    </form>

                    <!-- Message d'information pour les types de fichiers acceptés -->
                    <small class="text-muted d-block mt-2">JPG ou PNG, max 5 Mo</small>
                </div>
            </div>
        </div>

        <!-- Section droite: Formulaire de mise à jour du profil -->
        <div class="col-md-8">
            <div class="card card-custom">
                <div class="card-body">
                    <h4 class="card-title text-center" style="color: #4b4b4b;">Edit profile</h4>

                    <!-- Affichage du message de succès -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('customer.profil.update', ['id' => $profil_customer->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $profil_customer->name) }}">
                        </div>

                        <!-- Numéro de téléphone -->
                        <div class="mb-3">
                            <label for="no_hp" class="form-label">Phone number</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp', $profil_customer->no_hp) }}">
                        </div>

                        <!-- Date de naissance -->
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Date of birth</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $profil_customer->tanggal_lahir) }}">
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail address</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $profil_customer->email) }}">
                        </div>

                        <!-- Nouveau mot de passe -->
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
                        </div>

                        <!-- Confirmation du mot de passe -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm new password">
                        </div>
<!-- Nom de l'association -->
<div class="mb-3">
    <label for="association" class="form-label">Association</label>
    <input type="text" name="association" id="association" class="form-control" value="{{ $association->nom ?? '' }}">
</div>
                       

                        <button type="submit" class="btn" style="background-color: #2aa14b; color: white; width: 100%;">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles CSS intégrés -->
<style>
    .card-custom {
        background-color: #e0e0e0; /* Couleur grise pour la carte */
    }
    .rounded-circle {
        border: 1px solid #CB6D51; /* Ajoute une bordure pour mieux délimiter l'image */
    }
</style>
@endsection

<!-- Inclure l'icône Bootstrap pour l'avatar par défaut -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
