<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Trainers;
use App\Models\Plans;


use App\Models\Announcement;
use App\Models\Members;
use App\Models\User;
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

    public function profile(){

        $user = Auth::user();
        $member = Members::where('email', $user->email)->firstOrFail();
        $plan=Plans::all();


        return view('frontend.Myprofile',compact('member','plan'));


    }

    public function updateProfile(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'mname' => 'required|string|max:255',
            'memail' => 'required|string|email|max:255|unique:members,email,' . $id,
            'maddress' => 'required|string|max:255',
            'mphone' => 'required|string|max:15',
        ]);

        // Find the member by ID
        $member = Members::findOrFail($id);

        // Update member attributes
        $member->name = $request->input('mname');
        $member->email = $request->input('memail');
        $member->address = $request->input('maddress');
        $member->phone = $request->input('mphone');

        // Save the updated member instance
        $member->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

   
}
