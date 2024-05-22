<?php

namespace App\Http\Controllers\backend;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainersappointments;
use App\Models\Trainers;



class AppointmentsController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'trainer_id' => 'required',
            'customer_name' => 'required',
            'date' => 'required|date',
            'time' => 'required'
        ]);

        // Check if appointment already exists for the given date, time, and trainer ID
        $existingAppointment = TrainersAppointments::where([
            'date' => $request->date,
            'time' => $request->time,
            'trainer_id' => $request->trainer_id
        ])->first();

        if ($existingAppointment) {
            // Appointment already exists, return back with an error message
            return response()->json(['success' => false, 'message' => 'Appointment not available for the selected date and time.'], 422);
        }

        // Create a new appointment instance
        $appointment = new TrainersAppointments();
        $appointment->trainer_id = $request->trainer_id;
        $appointment->customer_name = $request->customer_name;
        $appointment->date = $request->date;
        $appointment->time = $request->time;

        // Save the appointment
        $appointment->save();

        // Redirect back with a success message
        return response()->json(['success' => true, 'message' => 'Appointment scheduled successfully.']);
    }

    public function index()
    {
        $trainer = Auth::user();

        $appointments = $trainer->TrainersAppointments;


        // Get the authenticated user's email
        $email = auth()->user()->email;

        // Retrieve the trainer's ID based on their email
        $trainer = Trainers::where('trainer_email', $email)->first();

        if ($trainer) {
            // If trainer exists, retrieve their appointments based on their ID
            $trainerId = $trainer->id;
            $appointments = Trainersappointments::where('trainer_id', $trainerId)->get();
        } else {
            // Handle case where trainer does not exist
            return null;
        }
         return view('backend.Myappointmnets', compact('appointments'));
    }
}
