<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainers;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;


class TrainerController extends Controller
{
    public function index()
    {
        $packages = package::all(); // Fetch all packages from the database

    return view('backend.add_trainers',compact('packages'));
    }
    public function add_trainers(Request $request)
    {
        // Validate the incoming request data, including the photo
        $request->validate([
            'tname' => 'required|string|max:255',
            'temail' => 'required|email|unique:trainers,trainer_email',
            'taddress' => 'required|string|max:255',
            'tphone' => 'required|string|max:20',
            'assign_exercise' => 'required|string|max:255',
            'trainer_date_of_join' => 'required|date',
            'salary' => 'required|numeric',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg  ,gif|max:2048', // Validate photo upload
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
    

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('trainers'), $fileName); // Move the uploaded file to a folder
            $trainer->photo = $fileName; // Save the file name to the database
        }
    
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
    $packages = package::all();
    return view('backend.edit_trainers', compact('trainer','packages'));
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


public function tprofile(){

    $user = Auth::user();
    $trainer = Trainers::where('trainer_email', $user->email)->firstOrFail();


    return view('backend.Editprofile',compact('trainer'));


}

public function updateProfile(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'tname' => 'required|string|max:255',
            'temail' => 'required|string|email|max:255|unique:trainers,trainer_email,' . $id,
            'taddress' => 'required|string|max:255',
            'tphone' => 'required|string|max:15',
        ]);

        // Find the trainer by ID
        $trainer = Trainers::findOrFail($id);

        // Update trainer attributes
        $trainer->trainer_name = $request->input('tname');
        $trainer->trainer_email = $request->input('temail');
        $trainer->trainer_address = $request->input('taddress');
        $trainer->phone = $request->input('tphone');

        // Save the updated trainer instance
        $trainer->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



}

    
