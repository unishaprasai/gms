<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use App\Models\Trainers;
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
                $items = Package::all();
    
                // Fetch notifications for trainers or both trainers/members
                $notifications = Announcement::where('recipient', 'trainer')
                    ->orWhere('recipient', 'both')
                    ->get();
    
                return view('backend.home', compact('items', 'notifications'));
            }
    
            if ($userType == 'member') {
                $items = Package::all();
                $team = Trainers::all();
    
                // Fetch notifications for members or both users/members
                $notifications = Announcement::where('recipient', 'member')
                    ->orWhere('recipient', 'both')
                    ->get();
    
                return view('frontend.index', compact('items', 'notifications','team'));
            }
    
            if ($userType == 'admin') {
                // Fetch notifications for admin
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
