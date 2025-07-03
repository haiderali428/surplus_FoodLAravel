<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Save to DB
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Send email to admin
        Mail::to('admin@surplusfood.com')->send(new ContactMessageMail($request->name, $request->email, $request->message));

        return back()->with('success', 'Your message has been sent!');
    }
} 