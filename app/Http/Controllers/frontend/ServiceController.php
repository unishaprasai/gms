<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plans;


class ServiceController extends Controller
{
     public function index(){

        $plans=Plans::all();

        return view('frontend.services',compact('plans'));
        
    }
}
