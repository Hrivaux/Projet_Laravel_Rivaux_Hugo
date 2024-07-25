<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedSearch;

class SavedSearchController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'search_params' => 'required|json',
        ]);

        SavedSearch::create([
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'search_criteria' => $request->search_params,
        ]);

        return back()->with('success', 'Recherche sauvegardée avec succès.');
    }

    public function apply($id)
    {
        $search = SavedSearch::findOrFail($id);

        // Convertir les critères de recherche sauvegardés en tableau
        $criteria = json_decode($search->search_criteria, true);

        // Rediriger vers la page de recherche avec les critères sauvegardés
        return redirect()->route('annonces.search', $criteria);
    }
     public function destroy($id)
    {
        // Trouver la recherche sauvegardée par son ID
        $savedSearch = SavedSearch::findOrFail($id);

        // Supprimer la recherche sauvegardée
        $savedSearch->delete();

        // Rediriger avec un message de succès
        return back()->with('success', 'Recherche sauvegardée supprimée avec succès.');
    }
}
