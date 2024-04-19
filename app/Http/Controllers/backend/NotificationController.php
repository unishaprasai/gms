<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Notification;
use Illuminate\Http\Request;
class NotificationController extends Controller
{
    public function index()
    {

        // Fetch notifications based on user's role
        $notifications = Announcement::all();
        return view('backend.home', compact('notifications'));
    }

    public function markAllAsRead(Request $request)
    {
        // Logic to mark all notifications as read
        Notification::where('read', false)->update(['read' => true]);

        return response()->json(['success' => true]);
    }
}
