<?php

namespace App\Http\Controllers;

use App\Models\EvenementCollecte;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class EvenementCollecteController extends Controller
{
    // Lister tous les événements de collecte
    public function index()
    {
        $evenements = EvenementCollecte::with('notifications')->get();
        return view('EvenementCollecte.index', compact('evenements'));
    }

    // Afficher un événement de collecte spécifique
    public function show($id)
    {
        $evenement = EvenementCollecte::with('notifications')->findOrFail($id);
        return response()->json($evenement);
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('EvenementCollecte.create'); // Utiliser la bonne casse
    }

    // Créer un nouvel événement de collecte
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|min:3|max:255',
            'date' => 'required|date|after:today',
            'lieu' => 'required|string|min:3|max:255',
            'type_nourriture' => 'required|string|min:3|max:255',
            'organisateur' => 'required|string|min:3|max:255',
        ]);

        $evenement = EvenementCollecte::create($request->all());

        // Message de succès
        return redirect()->route('evenement-collecte.index')->with('success', 'Événement de collecte créé avec succès !');
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $evenement = EvenementCollecte::findOrFail($id);
        return view('EvenementCollecte.edit', compact('evenement'));
    }

    // Mettre à jour un événement de collecte existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|min:3|max:255',
            'date' => 'required|date|after:today',
            'lieu' => 'required|string|min:3|max:255',
            'type_nourriture' => 'required|string|min:3|max:255',
            'organisateur' => 'required|string|min:3|max:255',
        ]);

        $evenement = EvenementCollecte::findOrFail($id);
        $evenement->update($request->all());
        return redirect()->route('evenement-collecte.index')->with('success', 'Événement de collecte mis à jour avec succès !');
    }

    // Supprimer un événement de collecte
    public function destroy($id)
    {
        $evenement = EvenementCollecte::findOrFail($id);
        $evenement->delete();
        return redirect()->route('evenement-collecte.index')->with('success', 'Événement de collecte supprimé avec succès !');
    }

    public function downloadPDF()
    {
        $evenements = EvenementCollecte::all(); // Récupérer tous les événements
    
        $pdf = PDF::loadView('EvenementCollecte.pdf', compact('evenements'));
    
        return $pdf->download('evenements.pdf');
    }
    
}
