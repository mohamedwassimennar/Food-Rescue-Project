<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\Association;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    // Afficher le formulaire de demande
    public function create()
    {
        return view('demandes.create');
    }

    // Vérifier l'association via une requête AJAX
    public function checkAssociation(Request $request)
    {
        // Journaux pour déboguer
        \Log::info('Requête reçue pour vérifier l\'association', ['nom' => $request->nom]);

        // Valider la requête
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        // Rechercher l'association par son nom
        $association = Association::where('nom', $request->nom)->first();

        // Retourner une réponse JSON
        if ($association) {
            return response()->json([
                'exists' => true,
                'association_id' => $association->id,
            ]);
        } else {
            return response()->json([
                'exists' => false,
            ]);
        }
    }

    // Enregistrer la demande
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validated = $request->validate([
            'association_id' => 'required|exists:associations,id',
            'produit' => 'required|string|max:255',
            'quantite' => 'required|integer|min:1',
            'date_collecte' => 'required|date|after_or_equal:today',
        ]);

        // Créer la nouvelle demande
        $demande = new Demande();
        $demande->association_id = $validated['association_id'];
        $demande->produit = $validated['produit'];
        $demande->quantite = $validated['quantite'];
        $demande->date_collecte = $validated['date_collecte'];
        $demande->save();

        // Rediriger avec un message de succès
        return redirect()->route('demandes.create')->with('success', 'demands created successfully!');
    }
// Afficher les demandes de l'utilisateur actuel
public function mesDemandes(Request $request)
{
    // Récupérer l'utilisateur connecté
    $user = Auth::user();

    // Vérifier si l'utilisateur appartient à une association
    if (!$user || !$user->association) {
        return redirect()->back()->with('error', 'You are not associated with an association.');
    }

    // Récupérer l'association de l'utilisateur
    $association = $user->association;

    // Récupérer les demandes selon l'état sélectionné
    $query = $association->demandes();

    // Si un état est fourni dans la requête, on filtre les demandes
    if ($request->filled('etat')) {
        $query->where('etat', $request->etat);
    }

    // Exécuter la requête et récupérer les résultats avec pagination
    $demandes = $query->paginate(6); // Utiliser $query ici

    // Retourner la vue avec les demandes et l'état de la recherche
    return view('demandes.index', compact('demandes'));
}
 public function destroy($id)
    {
        $demande = Demande::findOrFail($id); // Trouver la demande par ID
        $demande->delete(); // Supprimer la demande

        return redirect()->back()->with('success', 'Demande supprimée avec succès.'); // Rediriger avec message de succès
    }
public function edit($id)
{
    $demande = Demande::findOrFail($id); // Trouver la demande par ID

    // Ajouter un message de succès à la session si besoin
    session()->flash('success', 'You can now edit the request demands.');

    return view('demandes.edit', compact('demande'));
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'produit' => 'required|string',
            'quantite' => 'required|integer',
            'date_collecte' => 'required|date',
        ]);

        $demande = Demande::findOrFail($id);
        $demande->update($request->all()); 

return redirect()->route('demandes.mesdemandes')->with('success', 'Demands updated successfully.');
    }
   public function index()
{
    $demandes = Demande::with('association')->get(); 
    return view('admin.list_demandes.index', compact('demandes'));
}
    public function updatee(Request $request, Demande $demande)
    {
        $request->validate([
            'etat' => 'required|in:Onhold,Accepted,Refused', // Validation de l'état
        ]);

        $demande->etat = $request->etat; // Mise à jour de l'état
        $demande->save(); // Sauvegarder les changements

        return redirect()->route('admin.list_demandes.index')->with('success', 'demands status updated successfully.');
    } 

}