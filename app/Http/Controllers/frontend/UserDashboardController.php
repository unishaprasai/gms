<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class UserDashboardController extends Controller
{
    public function index(){
    $items = Package::all(); // Fetch all packages from the database
    return view('frontend.index', compact('items'));



    }
}
