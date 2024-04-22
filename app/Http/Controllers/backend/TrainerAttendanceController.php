<?php

namespace App\Http\Controllers\backend;
use App\Models\User;
use App\Models\TrainerAttendance;
use App\Models\Trainers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;



class TrainerAttendanceController extends Controller
{

    // public function index()
    // {
    //     // Get the user's email used for login
    //     $email = auth()->user()->email;

    //     // Find the trainer's ID based on the user's email from the trainers table
    //     $trainerId = Trainers::where('trainer_email', $email)->value('id');

    //     // Fetch the attendance history for the trainer
    //     $attendanceHistory = TrainerAttendance::where('trainer_id', $trainerId)
    //         ->orderBy('attendance_date', 'desc')
    //         ->get();

    //     return view('backend.attendance', compact('attendanceHistory'));
    // }
    public function checkIn()
    {
        // Get the authenticated user (trainer)
        $trainer = Auth::user();
    
        // Check if the trainer is valid and logged in
        if (!$trainer) {
            return redirect()->route('trainer.login')->with('error', 'Invalid user.');
        }
    
        $attendanceDate = now()->toDateString();
    
        // Check if the trainer has already checked in for today
        $existingAttendance = $trainer->attendance()->whereDate('attendance_date', $attendanceDate)->first();
    
        if ($existingAttendance) {
            return redirect()->with('error', 'You have already checked in today.');
        }
    
        // Get the trainer's ID based on their email from the trainers table
        $trainerId = Trainers::where('trainer_email', $trainer->email)->value('id');

    
        // Create new attendance record
        TrainerAttendance::create([
            'trainer_id' => $trainerId,
            'attendance_date' => $attendanceDate,
            'status' => 'Present',
        ]);
    
        return redirect()->with('success', 'Attendance recorded.');
    }

    public function index()
{
    $email = auth()->user()->email;

    // Find the trainer's details based on the email
    $trainerData = DB::table('trainers')
                    ->join('trainer_attendances', 'trainers.id', '=', 'trainer_attendances.trainer_id')
                    ->where('trainers.trainer_email', $email)
                    ->select('trainers.id as trainer_id', 'trainers.trainer_name as trainer_name', 'trainer_attendances.attendance_date', 'trainer_attendances.status')
                    ->get();

    return view('backend.attendance', compact('trainerData'));
}

}
