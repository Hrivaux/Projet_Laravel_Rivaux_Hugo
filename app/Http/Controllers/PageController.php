<?php

// app/Http/Controllers/PageController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Retourne la vue pour la page d'accueil
        return view('home');
    }

    public function contact()
    {
        // Retourne la vue pour la page de contact
        return view('contact');
    }

    public function about()
    {
        // Retourne la vue pour la page "Qui sommes-nous"
        return view('about');
    }
}
