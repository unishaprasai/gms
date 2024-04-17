<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\Attendance;
use Illuminate\Support\Facades\Validator;



class AttendanceController extends Controller
{

    public function index()
    {
        $members = Members::all();
        return view('backend.attendance', ['members' => $members]);
    }

    public function save_attendance(Request $request)
    {
        dd($request->all());
        // Validate the CSRF token manually
        if ($request->session()->token() !== $request->input('_token')) {
            // CSRF token mismatch, handle the error
            return redirect()->back()->with('error', 'CSRF token mismatch. Please try again.');
        }
 
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'attendance_date' => 'required|date',
                'attendance_shift' => 'required|in:morning,afternoon,evening',
                'present_absent' => 'required|array',
                'present_absent.*' => 'in:present,absent,late',
                'percentage' => 'required|array',
                'percentage.*' => 'numeric|between:0,100',
            ]);
          

            // Get the attendance date and shift from the request
            $attendanceDate = $validatedData['attendance_date'];
            $attendanceShift = $validatedData['attendance_shift'];

            dd($request->all());

            // Get the member IDs, status, and percentages from the request
            $presentAbsent = $request->input('present_absent');
            $percentages = $request->input('percentage');

            // Assuming member IDs are passed as hidden inputs in the form
            $memberIds = $request->input('member_id');

            // Loop through each member and save their attendance record
            foreach ($memberIds as $key => $memberId) {
                Attendance::create([
                    'member_id' => $memberId,
                    'attendance_date' => $attendanceDate,
                    'status' => $presentAbsent[$key],
                    'shift' => $attendanceShift,
                    'percentage' => $percentages[$key],
                ]);
            }

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Attendance saved successfully!');

        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving attendance: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Error saving attendance. Please try again.');
        }
    }
    }
    

