<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivityLog;

class LogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::all();
        return view('logs.index',compact('logs'));
    }
}
