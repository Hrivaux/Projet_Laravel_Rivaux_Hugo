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
        $user = auth()->user();

        $favoris = $user->favoris()->with('photos')->get();

        $savedSearches = SavedSearch::where('user_id', $user->id)->get();

        $annoncesDeposees = BienImmo::where('created_by', $user->id)->with('photos')->get();

        return view('moncompte.index', compact('user', 'favoris', 'savedSearches', 'annoncesDeposees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'password' => 'nullable|string|min:8|confirmed', 
        ]);

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

    public function saveSearch(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'search_criteria' => 'required|string', 
        ]);

        $user = auth()->user();

        SavedSearch::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'search_criteria' => $request->search_criteria,
        ]);

        return back()->with('success', 'Recherche sauvegardée avec succès.');
    }

    public function deleteSearch($id)
    {
        $search = SavedSearch::findOrFail($id);
        $search->delete();

        return back()->with('success', 'Recherche supprimée avec succès.');
    }
}
