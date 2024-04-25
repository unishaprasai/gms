<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Trainers;

class UserDashboardController extends Controller
{
    public function index(){
       
        $items = Package::all();
    
       
        $team = Trainers::all();
        
        $data = compact('items', 'team');
    
        return view('frontend.index', $data);
    }
    



    }
