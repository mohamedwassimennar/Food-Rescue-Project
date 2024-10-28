<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Association;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;

class ProfileCustomerController extends Controller
{
    // Afficher le profil du client
public function show($id)
{
    $user = User::with('association')->findOrFail($id); 

    $association = $user->association;
        Log::info('Association:', ['association' => $association]);


    $data = [
        'profil_customer' => $user, 
        'user' => $user,
        'association' => $association, 
    ];

    return view('customer.profil', $data);
}
   public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8|confirmed',
        'association_id' => 'nullable|exists:associations,id', // Validation pour l'association
    ]);

    // Récupérer l'utilisateur avec l'association
    $profil_customer = User::with('association')->findOrFail($id);

    // Mettre à jour les informations
    $profil_customer->name = $request->name;
    $profil_customer->email = $request->email;

    if ($request->filled('password')) {
        $profil_customer->password = Hash::make($request->password);
    }

    // Mettre à jour l'association si elle est spécifiée
    if ($request->has('association_id')) {
        $profil_customer->association_id = $request->association_id; 
    }

    $profil_customer->save();

    return redirect()->route('customer.profil', ['id' => $profil_customer->id])
                     ->with('success', 'Profile updated successfully.');
}


    // Mettre à jour la photo de profil
    public function updatePhoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        // Supprimer l'ancienne photo si elle existe
        if ($user->foto) {
            Storage::delete('public/' . $user->foto);
        }

        // Stocker la nouvelle photo
        $path = $request->file('foto')->store('photos', 'public');

        // Mettre à jour le chemin de la photo dans la base de données
        $user->update(['foto' => $path]);

        return redirect()->route('customer.profil', $user->id)
                         ->with('success', 'Profile picture updated successfully..');
    }
}