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
    public function checkIn()
    {
        // Get the authenticated user (member)
        $member = Auth::user();
    
        // Check if the member is valid and logged in
        if (!$member) {
            return redirect()->with('error', 'Invalid user.');
        }
    
        $attendanceDate = now()->toDateString();
    
        // Check if the member has already checked in for today
        $existingAttendance = MemberAttendance::where('member_id', $member->id)
            ->whereDate('attendance_date', $attendanceDate)
            ->first();
    
        if ($existingAttendance) {
            return redirect()->with('error', 'You have already checked in today.');
        }
    
        // Get the member's ID based on their email from the trainers table
        $memberid = Members::where('email', $member->email)->value('id');
    
        // Ensure the trainer ID exists
        if (!$memberid) {
            return redirect()->with('error', 'Member ID not found.');
        }
    
        // Create new attendance record
        MemberAttendance::create([
            'member_id' => $memberid,
            'attendance_date' => $attendanceDate,
            'status' => 'Present',
        ]);
    
        return redirect()->back()->with('success', 'Attendance recorded.');
    }




}




