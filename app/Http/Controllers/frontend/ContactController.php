<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

use App\Mail\ContactFormSubmitted;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
        ]);

        try {
            // Send email
            Mail::to('unishaprasai319@gmail.com')->send(new ContactFormSubmitted($validatedData));

            // Log success
            Log::info('Email sent successfully!');

            // Redirect back with a success message
            return redirect()->back()->with('status', 'success');
        } catch (\Exception $e) {
            // Log error
            Log::error('Error sending email: ' . $e->getMessage());

            // Redirect back with the specific error message
            return redirect()->back()->with('status', 'error')->with('error_message', $e->getMessage());
        }
    }
}