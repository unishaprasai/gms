<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Trainers;

class PackageController extends Controller
{
    public function index()
    {
        return view('backend.add_package');
    }

    public function add_package(Request $request)
    {
        $validatedData = $request->validate([
            'package_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'assign_trainer' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_in_days' => 'required|integer|min:1',
        ]);

        $package = Package::create($validatedData);

        return redirect()->back()->with('success', 'Package added successfully!');
    }
}
