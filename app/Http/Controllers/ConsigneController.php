<?php

namespace App\Http\Controllers;

use App\Models\Consigne;
use Illuminate\Http\Request;

class ConsigneController extends Controller
{
    
    public function index()
    {
        $consignes = Consigne::all();
        return view('consignes.index', compact('consignes'));
    }

   
    public function create()
    {
        return view('consignes.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'expediteur' => 'required|string|max:255',
            'destinataire' => 'required|string|max:255',
            'contenu' => 'required',
            'statut' => 'required|in:Envoyé,Reçu',
        ]);

        Consigne::create($request->all());

        return redirect()->route('consignes.index')->with('success', 'Consigne created successfully.');
    }

   
    public function show(Consigne $consigne)
    {
        return view('consignes.show', compact('consigne'));
    }

   
    public function edit(Consigne $consigne)
    {
        return view('consignes.edit', compact('consigne'));
    }

   
    public function update(Request $request, Consigne $consigne)
    {
        $request->validate([
            'expediteur' => 'required|string|max:255',
            'destinataire' => 'required|string|max:255',
            'contenu' => 'required',
            'statut' => 'required|in:Envoyé,Reçu',
        ]);

        $consigne->update($request->all());

        return redirect()->route('consignes.index')->with('success', 'Consigne updated successfully.');
    }

    
    public function destroy(Consigne $consigne)
    {
        $consigne->delete();

        return redirect()->route('consignes.index')->with('success', 'Consigne deleted successfully.');
    }
}
