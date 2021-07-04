<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;
use App\Percentage;
use Storage;

class ShopController extends Controller
{
    
    public function index(){
        $shop = Configuration::first();
        $percentages = Percentage::all();
        return view('shop.index',compact('shop','percentages'));
    }

    public function store(Request $request)
    {
        try{
            $shop=Configuration::find($request->id);
            $shop->owner = $request->owner;
            $shop->shop_name = $request->shop_name;
            $shop->business_name = $request->business_name;
            $shop->address = $request->address;
            $shop->email = $request->email;
            $shop->phone = $request->phone;
            $shop->phone2 = $request->phone2;
            $shop->nrc = $request->nrc;
            $shop->nit = $request->nit;
            if(!is_null($request->logo)){
              $shop->logo = url(Storage::url($this->uploadImage($request)));
            }

            $shop->save();
            return array(1);
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }

    public function percentages(Request $request){
        try{
            $porcentaje=Percentage::find($request->id);
            $porcentaje->porcentaje=$request->porcentaje;
            $porcentaje->save();
            return array(1,"exito");
        }catch(Exception $e){
            return array(-1,"error",$e->getMessage());
        }
    }

    private function uploadImage($request){
        $imageSize = getimagesize($request->logo);
        $avatarExtension = image_type_to_extension($imageSize[2]);
        $filename = Storage::putFile('images/logos', $request->logo, 'public');
        return $filename;
    }

}
