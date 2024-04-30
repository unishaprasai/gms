<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainers;

class AboutUsController extends Controller
{
    public function index(){
        $team = Trainers::all();


        return view('frontend.about-us',compact('team'));
        
    }
}
