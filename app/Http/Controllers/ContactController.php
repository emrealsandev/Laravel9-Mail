<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        // Send Email
        Mail::to('emrealsandev@gmail.com')
        ->send(new ContactMail($validated['email'],$validated['subject'],$validated['message']));
        return ['success' => true];
    }
}
