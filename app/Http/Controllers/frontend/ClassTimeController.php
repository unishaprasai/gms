<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\classes;


class ClassTimeController extends Controller
{
    public function index(){
        $classes = Classes::all();

        return view('frontend.class-details',['classes' => $classes]);
        
    }

}
