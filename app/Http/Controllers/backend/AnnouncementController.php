<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{

    
    public function index()
    {
        return view('backend.add_announcements');
    }
    public function store(Request $request)
{
    $announcement = new Announcement();
    $announcement->title = $request->input('title');
    $announcement->content = $request->input('content');
    $announcement->recipient = $request->input('recipient');
    $announcement->save();

    return redirect()->back()->with('success', 'Announcements added successfully!');
}

public function view()
{
    $Announcements = Announcement::all();
    return view('backend.view_announcement', compact('Announcements'));
}

public function delete($id)
{
    $Announcements = Announcement::find($id);

    if (!$Announcements) {
        // Announcement not found, you may want to handle this case differently
        return redirect()->back()->with('error', 'Announcements not found!');
    }

    // Delete the Announcement
    $Announcements->delete();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Announcement deleted successfully!');
}

}
