<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\members;
use Illuminate\Support\Facades\Hash;      
use Illuminate\Support\Facades\Storage;
use App\Models\Package;


class MemberController extends Controller
{


public function add_member()
{      $packages = package::all(); // Fetch all packages from the database

    return view('backend.add_members',compact('packages'));
}





public function add_members(Request $request)
{
    // dd($request->all());
    // Create a new instance of the Member model
    $member = new Members;
    $packages = package::all();

    // Assign values from the request to the model attributes
    $member->name = $request->input('mname');
    $member->email = $request->input('memail');
    $member->address = $request->input('maddress');
    $member->phone = $request->input('mphone');
    $member->date_of_join = $request->input('date_of_join'); // Changed to match the form input name
    $member->membership_type = $request->input('membership_type'); // Changed to match the form input name
    $member->shift = $request->input('shift');

    $validatedData = $request->validate([
        'maddress' => 'required|string|max:255',
        'mphone' => 'required|string|max:20',
        'date_of_join' => 'required|date',
        'membership_type' => 'nullable|string|max:255', 
        'shift' => 'required|string|max:50',
    ]);
    

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

public function view_members()
{
    $members=members::all();

    return view('backend.view_members',compact('members'));
}


public function delete_members($id)
{
    $members=members::find($id);
    $members->delete();

    return redirect()->back()->with('success','Member Deleted Sucessfully');
}


public function edit_members($id)
{
    $packages = package::all(); // Fetch all packages from the database

    
    $members=members::find($id);
    return view('backend.edit_members',compact('members','packages'));
}

public function update_member(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'mname' => 'required',
        'memail' => 'required|email',
        'maddress' => 'required',
        'mphone' => 'required',
        'date_of_join' => 'required|date',
        'membership_type' => 'required',
        'shift' => 'required',
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate photo upload
    ]);

    // Find the member by ID
    $members = Members::findOrFail($id);

    // Update member details
    $members->name = $request->input('mname');
    $members->email = $request->input('memail');
    $members->address = $request->input('maddress');
    $members->phone = $request->input('mphone');
    $members->date_of_join = $request->input('date_of_join');
    $members->membership_type = $request->input('membership_type');
    $members->shift = $request->input('shift');

    // Handle photo update if a new photo is provided
    if ($request->hasFile('photo')) {
        // Delete the previous photo if exists
        if ($members->photo) {
            Storage::delete($members->photo);
        }
        
        // Store the new photo
        $photoPath = $request->file('photo')->store('public/photos');
        $members->photo = $photoPath;
    }

    // Save the changes
    $members->save();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Member details updated successfully');
}

}
