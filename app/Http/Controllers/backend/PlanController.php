<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Plans;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(){
        $plan = Plans::all();


        return view('backend.add_plans',compact('plan'));
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string',
        'price' => 'required|numeric',
        'duration' => 'required|string',
        'features' => 'nullable|array', // Assuming features are optional and submitted as an array
    ]);

    $featuresString = implode(', ', $data['features'] ?? []);

    Plans::create([
        'title' => $data['title'],
        'price' => $data['price'],
        'duration' => $data['duration'],
        'features' => $featuresString, 
    ]);

    return redirect()->back()->with('success', 'Pricing created successfully!');
}

}
