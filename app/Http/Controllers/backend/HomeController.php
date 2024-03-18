<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth()->user()->usertype; // corrected syntax
            if ($usertype == 'trainer') {
                return view('dashboard');
            }

            if ($usertype == 'admin') {
                return view('backend.home');
            } else {
                return redirect()->back();
            }
        }
    }
}
