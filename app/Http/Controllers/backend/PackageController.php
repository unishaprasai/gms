<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Trainers;

class PackageController extends Controller
{
    public function index()
    {

        $trainers = Trainers::pluck('trainer_name', 'id');
        return view('backend.add_package', compact('trainers'));;
    }

    public function add_package(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'package_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'assign_trainer' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_in_days' => 'required|integer|min:1',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate photo upload
        ]);

        

        // Check if a photo was uploaded
        if ($request->hasFile('photo')) {
            // Store the uploaded photo in the public storage directory
            $photoPath = $request->file('photo')->store('public/packages');

            // Update the photo field in the validated data
            $validatedData['photo'] = $photoPath;
        }

        // Create a new package with the validated data
        $package = Package::create($validatedData);

        return redirect()->back()->with('success', 'Package added successfully!');
    }



    public function view_package()
    {
        $packages = Package::with('trainer')->get();

        return view('backend.view_package', ['packages' => $packages]);
    }
    public function delete_package($package_id)
    {
        // Find the package by ID
        $package = Package::find($package_id);
    
        // Check if the package exists
        if (!$package) {
            return redirect()->back()->with('error', 'Package not found!');
        }
    
        // Delete the associated photo file if it exists
        if ($package->photo) {
            // Get the full path to the photo file
            $photoPath = public_path('packages/' . $package->photo);
    
            // Check if the file exists before attempting deletion
            if (file_exists($photoPath)) {
                try {
                    unlink($photoPath); // Delete the file
                } catch (\Exception $e) {
                    // Log or handle the exception
                    Log::error('Error deleting photo: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Failed to delete photo file!');
                }
            } else {
                Log::warning('Photo file not found: ' . $photoPath);
            }
        } else {
            Log::warning('No photo associated with the package: ' . $package_id);
        }
    
        // Delete the package
        $package->delete();
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Package deleted successfully!');
    }
    
    

    public function edit_package($package_id)
    {
        $packages = Package::findOrFail($package_id); // Retrieve the class by ID
        $trainers = Trainers::pluck('trainer_name', 'id');

        return view('backend.edit_package', compact('packages', 'trainers'));
    }

    public function update_package(Request $request, $package_id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'assign_trainer' => 'required|exists:trainers,id', // Ensure the trainer ID exists in the trainers table
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'duration_in_days' => 'required|numeric',
        ]);

        // Find the package by ID
        $package = Package::findOrFail($package_id);

        // Update package details
        $package->name = $validatedData['name'];
        $package->assign_trainer = $validatedData['assign_trainer'];
        $package->description = $validatedData['description'];
        $package->price = $validatedData['price'];
        $package->duration_in_days = $validatedData['duration_in_days'];
        $package->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Package updated successfully!');
    }
}
