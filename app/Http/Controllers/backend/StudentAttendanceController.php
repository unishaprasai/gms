<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MemberAttendance;
use App\Models\Members;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;




class StudentAttendanceController extends Controller
{
    public function index()
    {
        $email = auth()->user()->email;
    
        // Find the member's details based on the email
        $memberData = DB::table('members')
                        ->join('member_attendances', 'members.id', '=', 'member_attendances.member_id')
                        ->where('members.email', $email)
                        ->select('members.id as member_id', 'members.name as member_name', 'member_attendances.attendance_date', 'member_attendances.status')
                        ->get();
    
        return view('frontend.attendance_sheet', compact('memberData'));
    }
    // public function checkIn()
    // {
    //     // Get the authenticated user (member)
    //     $member = Auth::user();
    
    //     // Check if the member is valid and logged in
    //     if (!$member) {
    //         return redirect()->with('error', 'Invalid user.');
    //     }
    
    //     $attendanceDate = now()->toDateString();
    
    //     // Check if the member has already checked in for today
    //     $existingAttendance = MemberAttendance::where('member_id', $member->id)
    //         ->whereDate('attendance_date', $attendanceDate)
    //         ->first();
    
    //     if ($existingAttendance) {
    //         return redirect()->with('error', 'You have already checked in today.');
    //     }
    
    //     // Get the member's ID based on their email from the trainers table
    //     $memberid = Members::where('email', $member->email)->value('id');
    
    //     // Ensure the trainer ID exists
    //     if (!$memberid) {
    //         return redirect()->with('error', 'Member ID not found.');
    //     }
    
    //     // Create new attendance record
    //     MemberAttendance::create([
    //         'member_id' => $memberid,
    //         'attendance_date' => $attendanceDate,
    //         'status' => 'Present',
    //     ]);
    
    //     return redirect()->back()->with('success', 'Attendance recorded.');
    // }

    public function checkIn()
    {
        $user = auth()->user();
        // Get the members's ID based on their email from the members table
        $member = Members::where('email', $user->email)->first();
    
        // Ensure the trainer ID exists
        if (!$member) {

            return redirect()->back()->with('error', 'Member ID not found.');
        }
    
    
        $attendanceDate = now()->format('Y-m-d');

        // Check if the member has already checked in for today
        $existingAttendance = MemberAttendance::where('member_id', $member->id)
            ->where('attendance_date', $attendanceDate)
            ->first();


    
            if ($existingAttendance) {
                session()->flash('error', 'You have already checked in today.');
                return redirect()->back();
            }
            
    
        
    
        MemberAttendance::create([
            'member_id' => $member->id,
            'attendance_date' => $attendanceDate,
            'status' => 'Present',
        ]);

        return redirect()->back()->with('success', 'Attendance recorded.');
    }

        public function view_index()
    {
        $MemberAttendances =MemberAttendance ::with('member')->get();
    
    
        return view('backend.student_attendance', compact('MemberAttendances'));
    }

    public function delete($id)
    {
        // Find the member by ID
        $MemberAttendances = MemberAttendance::find($id);

        if (!$MemberAttendances) {
            // Class not found, you may want to handle this case differently (e.g., show error message)
            return redirect()->back()->with('error', 'Attendances not found!');
        }

        
        $MemberAttendances->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Attendance deleted successfully!');
    }

    public function manual(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'studentId' => 'required|numeric', // Assuming studentId is numeric
        'studentname' => 'required|string',
        'attendanceDate' => 'required|date',
        'status' => 'required|string',
    ]);

    // Create a new MemberAttendance instance
    $attendance = new MemberAttendance;
    $attendance->member_id = $validatedData['studentId'];
    $attendance->attendance_date = $validatedData['attendanceDate'];
    $attendance->status = $validatedData['status'];

    // Save the attendance record
    $attendance->save();

    // Redirect back with a success message
    return response()->json(['success' => true, 'message' => 'Attendance recorded successfully']);

    return redirect()->back()->with('success', 'Attendance recorded successfully!');
}




}




