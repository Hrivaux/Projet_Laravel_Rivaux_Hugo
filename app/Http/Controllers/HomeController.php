<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BienImmo;
use App\Models\SavedSearch;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Récupérer toutes les annonces de la table bien_immo avec leurs photos
        $annonces = BienImmo::with('photos')->get();

        // Vérifier si l'utilisateur est authentifié
        $savedSearches = [];
        if (Auth::check()) {
            // Récupérer les recherches sauvegardées pour l'utilisateur connecté
            $savedSearches = Auth::user()->savedSearches; // Assurez-vous que la relation est définie correctement
        }

        // Passer les données à la vue
        return view('home', compact('annonces', 'savedSearches'));
    }
}
