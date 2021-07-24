<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivityLog;

class LogController extends Controller
{
    public function index()
    {
        Auth()->user()->authorizeRoles(Auth()->user()->role_id);
        $logs = ActivityLog::orderBy('created_at','desc')->get();
        return view('logs.index',compact('logs'));
    }
}
