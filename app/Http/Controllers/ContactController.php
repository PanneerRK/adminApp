<?php

namespace App\Http\Controllers;

use App\Models\ContactForm;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        return view('pages.contact');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:contact_forms'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $contact = new ContactForm();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->back()->with('success', 'Contact form submitted successfully');  
    }
}
