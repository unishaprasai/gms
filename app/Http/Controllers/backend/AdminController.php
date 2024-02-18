<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\members;


class AdminController extends Controller
{
    public function view_members()
{
    return view('backend.view_members');
}

public function add_members(Request $request)
{
    // Create a new instance of the Member model
    $member = new Members;

    // Assign values from the request to the model attributes
    $member->name = $request->input('mname');
    $member->email = $request->input('memail');
    $member->address = $request->input('maddress');
    $member->phone = $request->input('mphone');
    $member->date_of_join = $request->input('date_of_join'); // Changed to match the form input name
    $member->membership_type = $request->input('membership_type'); // Changed to match the form input name
    $member->shift = $request->input('shift');

    // Handling file upload (photo)
    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('photos'), $fileName); // Move the uploaded file to a folder
        $member->photo = $fileName; // Save the file name to the database
    }

    // Save the member data to the database
    $member->save();

    // Optionally, you can redirect the user after saving the data
    return redirect()->back()->with('success', 'Member added successfully!');
}


}
