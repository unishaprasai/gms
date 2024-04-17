<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userType = Auth()->user()->usertype;
            Log::info("User Type: $userType");
    
            if ($userType == 'trainer') {
                // Fetch notifications for trainers
                $notifications = Announcement::where('recipient', 'trainer')->get();
                return view('backend.home', compact('notifications'));
            }
    
            if ($userType == 'member') {
                // Redirect members to the frontend index
                return redirect()->route('frontend.index');
            }
    
            if ($userType == 'admin') {
                // Fetch notifications for admins
                $notifications = Announcement::where('recipient', 'admin')->get();
                return view('backend.home', compact('notifications'));
            }
    
            // For other user types, redirect back
            return redirect()->back();
        } else {
            Log::info("User not authenticated");
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
    }
    
}
