<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth()->user()->usertype;
            Log::info("User Type: $usertype");
    
            if ($usertype == 'trainer') {
                return view('dashboard');
            }
    
            if ($usertype == 'admin') {
                return view('backend.home');
            } else {
                return redirect()->back();
            }
        } else {
            Log::info("User not authenticated");
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
    }
}
