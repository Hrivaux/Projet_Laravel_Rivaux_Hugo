<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MonCompteController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        // Charger les annonces favorites de l'utilisateur avec les photos associées
        $favoris = $user->favoris()->with('photos')->get();

        // Passer les données à la vue
        return view('moncompte.index', compact('user', 'favoris'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            // Ajoutez d'autres règles de validation au besoin
        ]);

        // Mettre à jour l'utilisateur
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Vos informations ont été mises à jour avec succès.');
    }
}
