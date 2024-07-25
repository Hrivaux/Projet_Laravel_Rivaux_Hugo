<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\SavedSearch;

class AnnonceController extends Controller
{
    // Méthode pour rechercher les annonces
    public function search(Request $request)
    {
        // Récupérer les annonces en fonction des critères de recherche
        $annonces = Annonce::query()
            ->when($request->ville, function ($query, $ville) {
                return $query->where('ville', 'like', "%{$ville}%");
            })
            ->when($request->prix_min, function ($query, $prix_min) {
                return $query->where('prix', '>=', $prix_min);
            })
            ->when($request->prix_max, function ($query, $prix_max) {
                return $query->where('prix', '<=', $prix_max);
            })
            ->when($request->superficie_min, function ($query, $superficie_min) {
                return $query->where('superficie', '>=', $superficie_min);
            })
            ->when($request->superficie_max, function ($query, $superficie_max) {
                return $query->where('superficie', '<=', $superficie_max);
            })
            ->when($request->type, function ($query, $type) {
                return $query->where('type', $type);
            })
            ->when($request->ordre, function ($query, $ordre) {
                return $query->orderBy('prix', $ordre === 'prix_asc' ? 'asc' : 'desc');
            })
            ->get();

        // Récupérer les recherches sauvegardées de l'utilisateur connecté
        $savedSearches = $request->user() ? SavedSearch::where('user_id', $request->user()->id)->get() : collect();

        // Passer les données à la vue
        return view('home', compact('annonces', 'savedSearches'));
    }

    // Afficher le formulaire d'édition d'une annonce
public function edit($id)
    {
        $annonce = Annonce::findOrFail($id);
        return view('annonces.edit', compact('annonce'));
    }

    // Mettre à jour une annonce
public function update(Request $request, $id)
{
    $annonce = Annonce::findOrFail($id);

    // Validation des données
    $request->validate([
        'libelle' => 'required|string|max:255',
        'prix' => 'required|numeric',
        'etat' => 'required|string',
        'adresse' => 'required|string|max:255',
        'ville' => 'required|string|max:255',
        'code_postal' => 'required|string|max:10',
        'description' => 'required|string',
        'superficie' => 'required|numeric',
        'type' => 'required|string|max:50',
    ]);

    // Mise à jour des données
    $annonce->update([
        'libelle' => $request->input('libelle'),
        'prix' => $request->input('prix'),
        'etat' => $request->input('etat'),
        'adresse' => $request->input('adresse'),
        'ville' => $request->input('ville'),
        'code_postal' => $request->input('code_postal'),
        'description' => $request->input('description'),
        'superficie' => $request->input('superficie'),
        'type' => $request->input('type'),
    ]);

    return redirect()->route('annonces.edit', $annonce->id)->with('success', 'Annonce mise à jour avec succès.');
}
    // Supprimer une annonce
    public function destroy($id)
    {
        $annonce = Annonce::findOrFail($id);
        $annonce->delete();

        return redirect()->route('home')->with('success', 'Annonce supprimée avec succès.');
    }
    public function show($id)
{
    $annonce = Annonce::with('photos')->findOrFail($id);
    return view('annonces.show', compact('annonce'));
}

}
