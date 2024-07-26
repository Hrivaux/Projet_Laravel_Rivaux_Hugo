<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        $photo = Photo::create([
            'image_path' => $imagePath,
        ]);

        return back()
            ->with('success', 'Image uploaded successfully.')
            ->with('photo', $photo);
    }
}
