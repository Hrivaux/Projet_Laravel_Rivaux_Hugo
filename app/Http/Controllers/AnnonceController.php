<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce; // Assurez-vous d'importer le modèle Annonce si nécessaire

class AnnonceController extends Controller
{
    public function show($id)
    {
        $annonce = Annonce::findOrFail($id);
        return view('annonces.show', compact('annonce'));
    }
}

