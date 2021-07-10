<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function autorizacion(Request $request)
    {
        $request->validate([
            'username' => 'required|min:5|max:200',
            'password' => 'required|min:7',
        ]);
        if (Auth::once(['username' => $request->username, 
            'password' => $request->password])
            ) {
                sleep(2);
            return array(1,"exito",auth()->user()->role_id,$request->elid);
        }else{
            return array(-1,"error");
        }
        
    }
}
