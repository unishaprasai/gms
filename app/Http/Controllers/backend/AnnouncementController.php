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

}
