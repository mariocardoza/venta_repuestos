<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class Product extends Model
{
    use SoftDeletes;

    public function getUrlImageAttribute()
    {
        return \Storage::url($this->image);
    }

    public static function retornar_code($product_id,$code){
        $numero=ProductDetail::where('product_id',$product_id)->count();
        $numero+=1;
        return $code.'-'.$numero;
    }

    public static function stock($product_id){
        return ProductDetail::where('product_id',$product_id)->where('state',1)->count();
    }

    public function category()
    {
        return $this->belongsTo('App\Category')->withTrashed();
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory')->withTrashed();
    }


}
