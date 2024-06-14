<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BienImmo;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FavorisController extends Controller
{
    public function ajouter($bienImmoId)
    {
        try {
            $user = Auth::user();
            
            $bienImmo = BienImmo::findOrFail($bienImmoId);
            $user->favoris()->attach($bienImmoId);

            return back()->with('success', 'Bien immobilier ajouté aux favoris.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de l\'ajout du bien immobilier aux favoris.');
        }
    }

    public function supprimer($bienImmoId)
    {
        try {
            $user = Auth::user();
            $bienImmo = BienImmo::findOrFail($bienImmoId);
            $user->favoris()->detach($bienImmoId);

            return back()->with('success', 'Bien immobilier retiré des favoris.');
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur est survenue lors de la suppression du bien immobilier des favoris.');
        }
    }
}
