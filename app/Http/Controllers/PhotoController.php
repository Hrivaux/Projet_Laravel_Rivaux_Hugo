<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        // Validez et enregistrez l'image
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        // Enregistrez le chemin de l'image dans la base de données
        $photo = Photo::create([
            'image_path' => $imagePath,
        ]);

        return back()
            ->with('success', 'Image uploaded successfully.')
            ->with('photo', $photo);
    }
}
