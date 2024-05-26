<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;        
   
use Illuminate\Support\Facades\Hash;      
use Illuminate\Support\Facades\Storage;
use App\Mail\UserRegisteredMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function add_users()
    {
        return view('backend.add_users');
    }

    public function view_users()
    {
        $users = User::all();
        return view('backend.view_users', compact('users'));
    }

    public function store_users(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'uname' => ['required', 'string', 'max:255'],
            'uemail' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'upassword' => ['required', 'string', 'min:8'],
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

        // Send email to the user
    Mail::to($user->email)->send(new UserRegisteredMail($user->name, $user->email,$validatedData['upassword']));

        // Redirect back with success message
        return redirect()->back()->with('success', 'User added successfully');
    }

    public function delete_users($id){
       
         // Find the trainer by ID
    $users = User::find($id);

    if (!$users) {
        return redirect()->back()->with('error', 'User not found!');
    }

    // Delete the trainer
    $users->delete();

    // Redirect back with success message
    return redirect()->back()->with('success', 'User deleted successfully!');
        }
        

        public function edit_users($id)
        {
            $users = User::findOrFail($id);
            return view('backend.edit_users', compact('users'));
        }
    

        public function update_users(Request $request, $id)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'usertype' => 'required|in:Trainer,Member', // Example validation for user type
        // Add more validation rules for other fields as needed
    ]);

    // Find the user by ID
    $user = User::find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'User not found!');
    }

    // Update the user's data
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->usertype = $validatedData['usertype'];
    // Update other fields as needed

    $user->save();

    return redirect()->back()->with('success', 'User details updated successfully!');
}


}