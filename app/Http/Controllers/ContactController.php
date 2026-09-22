<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Envoi de l'email au service client
        // Mail::to('support@sendistribution.sn')->send(new ContactMail($validated));

        return back()->with('success', 'Votre message a bien été envoyé au service client. Nous vous répondrons dans les plus brefs délais.');
    }
}