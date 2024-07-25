<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BienImmo;
use App\Models\PhotoBien;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DeposerBienController extends Controller
{
    public function index()
    {
        return view('deposer_bien');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'libelle' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'etat' => 'required|string',
            'adresse' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'code_postal' => 'required|string|max:10',
            'description' => 'required|string',
            'superficie' => 'required|numeric',
            'type' => 'required|string|max:50',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Ajouter l'ID de l'utilisateur connecté
        $validatedData['created_by'] = Auth::id();

        // Créer un nouveau bien
        $bien = BienImmo::create($validatedData);

        // Gérer les fichiers téléchargés
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public'); // Stocker l'image dans le disque public

                // Enregistrer l'image dans la table photo_bien
                PhotoBien::create([
                    'id_bien' => $bien->id,
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('deposer_bien')->with('success', 'Bien déposé avec succès.');
    }
}
