<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function redirectDashboard(){
        return redirect()->route('dashboard');
    }

    public function index(){
        return view('home');
    }
}
