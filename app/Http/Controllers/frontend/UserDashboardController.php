<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Trainers;
use App\Models\Plans;

use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserDashboardController extends Controller
{
    public function index()
    {
        // if (Auth::check()) {
        //     $userType = Auth()->user()->usertype;
        //     Log::info("User Type: $userType");

            // if ($userType == 'member') {
                $items = Package::all();
                $team = Trainers::all();
                $plans=Plans::all();
            


            //     // dd($plans);

            //     // Fetch notifications for member or both trainers/members
            //     $notifications = Announcement::where('recipient', 'user')
            //         ->orWhere('recipient', 'both')
            //         ->get();

                // return view('frontend.index', compact('items', 'notifications', 'team','plans'));
                return view('frontend.index',compact('items', 'team','plans'));

            // }
        // }
    }
}
