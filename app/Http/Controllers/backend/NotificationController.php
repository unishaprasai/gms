<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
     
    // Fetch notifications based on user's role
    $notifications = Announcement::all();
    return view('backend.home', compact('notifications'));
    }
}
