<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainers;


class TeamController extends Controller
{
    public function index()
    {
        $team = Trainers::all(); // Fetch all packages from the database
        return view('frontend.team', compact('team'));
    }
}
