<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;
use App\Percentage;

class ShopController extends Controller
{
    
    public function index(){
        $shop = Configuration::first();
        $percentages = Percentage::all();
        return view('shop.index',compact('shop','percentages'));
    }
}
