<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestEmailController extends Controller
{
    public function sendTestEmail()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'message' => 'Ceci est un message de test.',
        ];

        Mail::send('emails.contact', ['contactData' => $data], function ($message) {
            $message->to('contact@imogogo.com')
                    ->subject('Test Email');
        });

        return 'Email envoyé avec succès!';
    }
}
