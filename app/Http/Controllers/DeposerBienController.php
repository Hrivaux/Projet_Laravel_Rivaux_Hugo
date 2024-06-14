<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BienImmo;

class DeposerBienController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'libelle' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'etat' => 'required|string',
            'adresse' => 'required|string',
            'ville' => 'required|string',
            'code_postal' => 'required|integer',
        ]);

        // Create a new BienImmo object and fill it with validated data
        $bienImmo = new BienImmo();
        $bienImmo->fill($validatedData);
        
        // Save the object to the database
        $bienImmo->save();

        // Redirect to a success page or perform other actions as needed
        return redirect()->route('deposer_bien')->with('success', 'Bien immo ajouté avec succès !');
    }
}
