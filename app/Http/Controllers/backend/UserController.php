<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;        
   
use Illuminate\Support\Facades\Hash;      
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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

        // Redirect back with success message
        return redirect()->back()->with('success', 'User added successfully');
    }
}
