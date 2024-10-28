@extends('layouts.app-demande')
@section('content')
<div class="container">
<h1 class="text-center mb-4" style="color: #4b4b4b;">Make a demands</h1>

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

    <div class="step-indicator mb-4">
        <div class="step active" id="step-indicator-1">1</div>
        <div class="step-line"></div>
        <div class="step" id="step-indicator-2">2</div>
        <div class="step-line"></div>
        <div class="step" id="step-indicator-3">3</div>
    </div>

    <form id="demandeForm" action="{{ route('demandes.store') }}" method="POST">
        @csrf

        <!-- Étape 1: Saisie du nom de l'association -->
        <div class="card form-step" id="step-1">
            <div class="card-body">
                <div class="form-group">
                    <label for="association_nom">Name of the association</label>
                    <input type="text" name="association_nom" id="association_nom" class="form-control" placeholder="Enter the name of the association" required>
                    <small id="associationError" class="text-danger d-none">association not found</small>
                </div>
                <button type="button" class="btn custom-btn-green mt-3" onclick="checkAssociation()">Next</button>
            </div>
        </div>

   <!-- Étape 2: Informations sur le produit et la collecte -->
<div class="card form-step d-none" id="step-2">
    <div class="card-body">
        <input type="hidden" name="association_id" id="association_id">

        <div class="form-group">
            <label for="produit">Product </label>
            <input type="text" name="produit" id="produit" class="form-control" placeholder="Product" required>
            <small id="produitError" class="text-danger d-none">Please enter a valid product.</small>
        </div>

        <div class="form-group">
            <label for="quantite">Quantity</label>
            <input type="number" name="quantite" id="quantite" class="form-control" placeholder="Quantité" required min="1">
            <small id="quantiteError" class="text-danger d-none">Please enter a valid quantity.</small>
        </div>

        <div class="form-group">
            <label for="date_collecte">Date of collection</label>
            <input type="date" name="date_collecte" id="date_collecte" class="form-control" required>
            <small id="dateCollecteError" class="text-danger d-none">Please enter a valid date.</small>
        </div>

        <button type="button" class="btn btn-secondary mt-3" onclick="prevStep()">Previous</button>
        <button type="button" class="btn custom-btn-green mt-3" onclick="nextStep()">Next</button>
    </div>
</div>

        <!-- Étape 3: Confirmation et soumission -->
        <div class="card form-step d-none" id="step-3">
            <div class="card-body">
                <h6>Confirm information before submitting:</h6>
                <p><strong>Association :</strong> <span id="confirmAssociation"></span></p>
                <p><strong>Product :</strong> <span id="confirmProduit"></span></p>
                <p><strong>Quantity:</strong> <span id="confirmQuantite"></span></p>
                <p><strong>Date of collection :</strong> <span id="confirmDate"></span></p>

                <button type="button" class="btn btn-secondary mt-3" onclick="prevStep()">Previous</button>
                <button type="submit" class="btn custom-btn-green mt-3">Submit</button>
            </div>
        </div>
    </form>
</div>

<style>
    .step-indicator {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .step {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #e0e0e0;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
    }
    .step.active {
        background-color: #CB6D51 ;
        color: white;
    }
    .step-line {
        flex-grow: 1;
        height: 2px;
        background-color: #e0e0e0;
        margin: 0 10px;
    }
    .card {
        margin-bottom: 20px;
    }
    .custom-btn-green {
    background-color: #2aa14b;
    border-color: #2aa14b;
    color: white;
}

.custom-btn-green:hover {
    background-color: #2aa14b;
    border-color: #2aa14b;
    color: white;
}
</style>

<script>
    let currentStep = 1;

    function checkAssociation() {
        const associationNom = document.getElementById('association_nom').value;

        if (!associationNom) {
            alert("Please enter an association name.");
            return;
        }

        // Requête AJAX pour vérifier l'association
        fetch('{{ route('check.association') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ nom: associationNom })
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                // Si l'association existe, passer à l'étape suivante
                document.getElementById('association_id').value = data.association_id;
                nextStep();
                document.getElementById('associationError').classList.add('d-none');
            } else {
                // Si l'association n'existe pas, afficher une erreur
                document.getElementById('associationError').classList.remove('d-none');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    }

function nextStep() {
    // Vérification des champs de l'étape 2
    if (currentStep === 2) {
        const produit = document.getElementById('produit').value;
        const quantite = document.getElementById('quantite').value;
        const dateCollecte = document.getElementById('date_collecte').value;

        // Réinitialiser les messages d'erreur
        document.getElementById('produitError').classList.add('d-none');
        document.getElementById('quantiteError').classList.add('d-none');
        document.getElementById('dateCollecteError').classList.add('d-none');

        let valid = true;

        // Vérifier si le produit est vide
        if (!produit) {
            document.getElementById('produitError').classList.remove('d-none');
            valid = false;
        }

        // Vérifier si la quantité est vide ou inférieure à 1
        if (!quantite || quantite < 1) {
            document.getElementById('quantiteError').classList.remove('d-none');
            valid = false;
        }

        // Vérifier si la date de collecte est vide ou invalide
       if (!dateCollecte) {
            document.getElementById('dateCollecteError').classList.remove('d-none');
            valid = false;
        } else {
            const today = new Date();
            const selectedDate = new Date(dateCollecte);

            // Vérifier si la date est avant aujourd'hui
            if (selectedDate < today.setHours(0, 0, 0, 0)) {
                document.getElementById('dateCollecteError').textContent = "The collection date must be today or in the future.";
                document.getElementById('dateCollecteError').classList.remove('d-none');
                valid = false;
            }
        }

        if (!valid) {
            return; // Ne pas avancer si les validations échouent
        }

        // Mise à jour des valeurs de confirmation
        document.getElementById('confirmAssociation').textContent = document.getElementById('association_nom').value;
        document.getElementById('confirmProduit').textContent = produit;
        document.getElementById('confirmQuantite').textContent = quantite;
        document.getElementById('confirmDate').textContent = dateCollecte;

        // Logique pour avancer à l'étape suivante ici
    }

    // Passer à l'étape suivante
    document.getElementById('step-' + currentStep).classList.add('d-none');
    document.getElementById('step-indicator-' + currentStep).classList.remove('active');
    currentStep++;
    document.getElementById('step-' + currentStep).classList.remove('d-none');
    document.getElementById('step-indicator-' + currentStep).classList.add('active');
}
function prevStep() {
    // Vérifier si l'on peut reculer à l'étape précédente
    if (currentStep > 1) {
        // Masquer l'étape actuelle
        document.getElementById(`step-${currentStep}`).classList.add('d-none');
        
        // Décrémenter le numéro de l'étape actuelle
        currentStep--;

        // Afficher l'étape précédente
        document.getElementById(`step-${currentStep}`).classList.remove('d-none');
    }
}

</script>
@endsection