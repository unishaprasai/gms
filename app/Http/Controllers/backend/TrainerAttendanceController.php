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
    public function checkIn()
    {
        $user = auth()->user();
        // Get the trainer's ID based on their email from the trainers table
        $trainer = Trainers::where('trainer_email', $user->email)->first();

        // Ensure the trainer ID exists
        if (!$trainer) {

            return redirect()->back()->with('error', 'Trainer ID not found.');
        }


        $attendanceDate = now()->format('Y-m-d');

        // Check if the trainer has already checked in for today
        $existingAttendance = TrainerAttendance::where('trainer_id', $trainer->id)
            ->where('attendance_date', $attendanceDate)
            ->first();



        if ($existingAttendance) {
            return redirect()->back()->with('error', 'You have already checked in today.');
        }



        // Create new attendance record
        TrainerAttendance::create([
            'trainer_id' => $trainer->id,
            'attendance_date' => $attendanceDate,
            'status' => 'Present',
        ]);

        return redirect()->back()->with('success', 'Attendance recorded.');
    }


    public function view_index()
    {
        $trainerAttendances = TrainerAttendance::with('trainer')->get();


        return view('backend.trainer_attendance', compact('trainerAttendances'));
    }

    public function delete($id)
    {
        // Find the trainer by ID
        $trainerAttendances = TrainerAttendance::find($id);

        if (!$trainerAttendances) {
            // Class not found, you may want to handle this case differently (e.g., show error message)
            return redirect()->back()->with('error', 'Attendances not found!');
        }

        // Delete the trainer
        $trainerAttendances->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Attendance deleted successfully!');
    }
}
