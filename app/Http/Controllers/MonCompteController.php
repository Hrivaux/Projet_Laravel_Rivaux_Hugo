<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SavedSearch; // Assurez-vous d'avoir créé ce modèle
use App\Models\BienImmo; // Assurez-vous d'avoir ce modèle
use Illuminate\Support\Facades\Hash;

class MonCompteController extends Controller
{
    public function index()
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();

        // Charger les annonces favorites de l'utilisateur avec les photos associées
        $favoris = $user->favoris()->with('photos')->get();

        // Charger les recherches sauvegardées de l'utilisateur
        $savedSearches = SavedSearch::where('user_id', $user->id)->get();

        // Charger les annonces déposées par l'utilisateur
        $annoncesDeposees = BienImmo::where('created_by', $user->id)->with('photos')->get();

        // Passer les données à la vue
        return view('moncompte.index', compact('user', 'favoris', 'savedSearches', 'annoncesDeposees'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'password' => 'nullable|string|min:8|confirmed', // Validation pour le mot de passe
        ]);

        // Mettre à jour l'utilisateur
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->ville = $request->ville;
        $user->adresse = $request->adresse;
        $user->code_postal = $request->code_postal;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Vos informations ont été mises à jour avec succès.');
    }

    // Méthode pour sauvegarder une recherche
    public function saveSearch(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'search_criteria' => 'required|string', // Assurez-vous de valider les critères de recherche
        ]);

        $user = auth()->user();

        SavedSearch::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'search_criteria' => $request->search_criteria,
        ]);

        return back()->with('success', 'Recherche sauvegardée avec succès.');
    }

    // Méthode pour supprimer une recherche sauvegardée
    public function deleteSearch($id)
    {
        $search = SavedSearch::findOrFail($id);
        $search->delete();

        return back()->with('success', 'Recherche supprimée avec succès.');
    }
}
