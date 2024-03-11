<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\members;
use App\Models\user;        
use App\Models\Trainers;   
use Illuminate\Support\Facades\Hash;      
use Illuminate\Support\Facades\Storage;




class AdminController extends Controller
{
    public function add_users()
    {
        return view('backend.add_users');
    }

    public function store_users(Request $request)
    {
 
        // Validate the form data
        $validatedData = $request->validate([
            'uname' => ['required', 'string', 'max:255'],
            'uemail' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'upassword' => ['required', 'string', 'min:8', 'confirmed'],
            'usertype' => ['required', 'string', 'in:trainer,member'],
        ]);

        // Create a new instance of the User model
        $user = new User;
     

        // Assign values from the request to the model attributes
        $user->name = $validatedData['uname'];
        $user->email = $validatedData['uemail'];
        $user->password = Hash::make($validatedData['upassword']); // Hash the password
        $user->usertype = $validatedData['usertype'];

        // Save the user data to the database
        $user->save();

        dd($user);

        // Redirect back with success message
        return redirect()->back()->with('success', 'User added successfully');
    }
public function add_member()
{
    return view('backend.add_members');
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
    $members=members::find($id);
    return view('backend.edit_members',compact('members'));
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



public function add_members(Request $request)
{
    // dd($request->all());
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

public function add_trainer()
{
    return view('backend.add_trainers');
}

public function add_trainers(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'tname' => 'required|string|max:255',
        'temail' => 'required|email|unique:trainers,trainer_email',
        'taddress' => 'required|string|max:255',
        'tphone' => 'required|string|max:20',
        'assign_exercise' => 'required|string|max:255',
        'trainer_date_of_join' => 'required|date',
        'salary' => 'required|numeric',
    ]);

    // Create a new instance of the Trainer model
    $trainer = new Trainers;

    // Assign values from the request to the model attributes
    $trainer->trainer_name = $request->input('tname');
    $trainer->trainer_email = $request->input('temail');
    $trainer->trainer_address = $request->input('taddress');
    $trainer->phone = $request->input('tphone');
    $trainer->salary = $request->input('salary');
    $trainer->Assign_exercise = $request->input('assign_exercise');
    $trainer->date_of_join = $request->input('trainer_date_of_join');

    // Save the trainer data to the database
    $trainer->save();

    // Optionally, you can redirect the user after saving the data
    return redirect()->back()->with('success', 'Trainer added successfully!');
}

public function view_trainers()
{
    $trainers = Trainers::all();
    return view('backend.view_trainers', compact('trainers'));
}

public function delete_trainers($id)
{
    // Find the trainer by ID
    $trainer = Trainers::find($id);

    if (!$trainer) {
        // Trainer not found, you may want to handle this case differently (e.g., show error message)
        return redirect()->back()->with('error', 'Trainer not found!');
    }

    // Delete the trainer
    $trainer->delete();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Trainer deleted successfully!');
}

public function edit_trainers($id)
{
    $trainer = Trainers::findOrFail($id);
    return view('backend.edit_trainers', compact('trainer'));
}
public function update_trainers(Request $request, $id)
{
    $request->validate([
        'tname' => 'required|string|max:255',
        'temail' => 'required|email|unique:trainers,trainer_email,'.$id,
        'taddress' => 'required|string|max:255',
        'tphone' => 'required|string|max:20',
        'assign_exercise' => 'required|string|max:255',
        'trainer_date_of_join' => 'required|date',
        'salary' => 'required|numeric',
    ]);

    $trainer = Trainers::findOrFail($id);
    $trainer->trainer_name = $request->input('tname');
    $trainer->trainer_email = $request->input('temail');
    $trainer->trainer_address = $request->input('taddress');
    $trainer->phone = $request->input('tphone');
    $trainer->salary = $request->input('salary');
    $trainer->Assign_exercise = $request->input('assign_exercise');
    $trainer->date_of_join = $request->input('trainer_date_of_join');
    $trainer->save();

    return redirect()->back()->with('success', 'Trainer updated successfully!');
}



}
