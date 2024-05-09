<?php

namespace App\Http\Controllers\backend;
use App\Models\Newenrollments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class EnrollmentController extends Controller
{
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'plan_title' => 'required|string',
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
        ]);
    
        // Create a new enrollment record
        $enrollment = new Newenrollments();
        $enrollment->plan_title = $validatedData['plan_title'];
        $enrollment->customer_name = $validatedData['customer_name'];
        $enrollment->customer_email = $validatedData['customer_email'];
        $enrollment->status = 'Pending'; // Default status
        $enrollment->save();
    
        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Enrollment successful!');
    } 

    public function view()
{

    $enrollments = Newenrollments::all();

    return view('backend.view_newenrollments', compact('enrollments'));
}



public function updateStatus(Request $request, Newenrollments $enrollment)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $enrollment->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Enrollment status updated successfully.');
    }

}



