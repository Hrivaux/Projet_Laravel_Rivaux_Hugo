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
    $request->validate([
        'libelle' => 'required|string|max:255',
        'prix' => 'required|numeric',
        'etat' => 'required|string',
        'adresse' => 'required|string|max:255',
        'ville' => 'required|string|max:255',
        'code_postal' => 'required|string|max:10',
        'description' => 'required|string',
        'superficie' => 'required|numeric',
        'type' => 'required|string',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    $bien = new BienImmo([
        'libelle' => $request->libelle,
        'prix' => $request->prix,
        'etat' => $request->etat,
        'adresse' => $request->adresse,
        'ville' => $request->ville,
        'code_postal' => $request->code_postal,
        'description' => $request->description,
        'superficie' => $request->superficie,
        'type' => $request->type,
        'created_by' => auth()->id(),
    ]);

    $bien->save();

    if($request->hasFile('images')) {
        foreach($request->file('images') as $image) {
            $path = $image->store('photos', 'public');

            $photo = new PhotoBien([
                'id_bien' => $bien->id,
                'image' => $path,
            ]);

            $photo->save();
        }
    }

        return redirect()->route('deposer_bien')->with('success', 'Bien déposé avec succès.');
}
}
