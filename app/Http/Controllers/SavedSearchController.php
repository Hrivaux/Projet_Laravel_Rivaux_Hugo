<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedSearch;

class SavedSearchController extends Controller
{
    // Sauvegarder une nouvelle recherche
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'search_criteria' => 'required|array',
        ]);

        SavedSearch::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'search_criteria' => $request->search_criteria,
        ]);

        return back()->with('success', 'Recherche sauvegardée avec succès.');
    }

    // Appliquer une recherche sauvegardée


    // Supprimer une recherche sauvegardée
    public function destroy($id)
    {
        $savedSearch = SavedSearch::findOrFail($id);
        $savedSearch->delete();

        return back()->with('success', 'Recherche sauvegardée supprimée avec succès.');
    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        $search = SavedSearch::findOrFail($id);
        return view('saved-searches.edit', compact('search'));
    }

    public function apply($id)
{
    $search = SavedSearch::findOrFail($id);
    $criteria = $search->search_criteria;

    return redirect()->route('annonces.search', $criteria);
}


    // Mettre à jour une recherche sauvegardée
public function update(Request $request, $id)
{
    $search = SavedSearch::findOrFail($id);

    // Validation des données
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'ville' => 'nullable|string|max:255',
        'prix_min' => 'nullable|numeric|min:0',
        'prix_max' => 'nullable|numeric|min:0',
        'superficie_min' => 'nullable|numeric|min:0',
        'superficie_max' => 'nullable|numeric|min:0',
        'type' => 'nullable|string|in:appartement,maison',
        'ordre' => 'nullable|string|in:prix_asc,prix_desc',
    ]);

    // Mise à jour de la recherche sauvegardée
    $search->name = $request->input('name');
    $search->search_criteria = $validatedData;
    $search->save();

      return back()->with('success', 'Recherche sauvegardée mise à jour avec succès.');
}
}
