<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BienImmo;

class BienImmoController extends Controller
{
    public function index()
    {
        // Récupérer toutes les annonces de la table bien_immo
        $annonces = BienImmo::all();

        // Passer les données à la vue
        return view('annonces.index', compact('annonces'));
    }

public function show($id)
{
    $annonce = BienImmo::with('photos')->findOrFail($id);
    return view('partials.annonce_detail', compact('annonce'));
}





}
