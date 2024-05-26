<?php

namespace App\Http\Controllers\Backend;

use App\Models\Payments;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use App\Models\Trainers;
use App\Models\Plans;
use App\Models\Announcement;
use App\Models\Members;
use App\Models\Newenrollments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $userType = Auth()->user()->usertype;
            Log::info("User Type: $userType");

            if ($userType == 'trainer') {
                $items = Package::all();
                $user =  User::count();
                $member = Members::count();
                $trainer = Trainers::count();
                $currentDate = Carbon::now()->format('Y-m-d');
                $enrollments = NewEnrollments::whereDate('created_at', $currentDate)->count();
                $payments = Payments::whereDate('created_at', $currentDate)->get();
                $totalAmountToday = $payments->sum('amount');
                $totalPaymentsToday = $payments->count();
                $notifications = Announcement::where('recipient', 'trainer')
                    ->orWhere('recipient', 'both')
                    ->get();

                return view('backend.home', compact('items', 'notifications','user', 'trainer', 'member', 'payments', 'enrollments','totalPaymentsToday','totalAmountToday'));
            }

            if ($userType == 'member') {
                $items = Package::all();
                $team = Trainers::all();
                $plans = Plans::all();

                // Fetch notifications for members or both users/members
                $notifications = Announcement::where('recipient', 'member')
                    ->orWhere('recipient', 'both')
                    ->get();

                return view('frontend.index', compact('items', 'notifications', 'team', 'plans'));
            }

            if ($userType == 'admin') {
                $user =  User::count();
                $member = Members::count();
                $trainer = Trainers::count();
                $currentDate = Carbon::now()->format('Y-m-d');
                $enrollments = NewEnrollments::whereDate('created_at', $currentDate)->count();
                $payments = Payments::whereDate('created_at', $currentDate)->get();
                $totalAmountToday = $payments->sum('amount');
                $totalPaymentsToday = $payments->count();
                $notifications = Announcement::where('recipient', 'admin')->get();
                return view('backend.home', compact('notifications', 'user', 'trainer', 'member', 'payments', 'enrollments','totalPaymentsToday','totalAmountToday'));
            }

            // For other user types, redirect back
            return redirect()->back();
        } else {
            Log::info("User not authenticated");
            return redirect()->route('login'); // Redirect to login if not authenticated
        }
    }
}
