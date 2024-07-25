<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Envoyer un email avec les informations du formulaire
        Mail::to('contact@imogogo.com')->send(new ContactMail($validatedData));

        return back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}
