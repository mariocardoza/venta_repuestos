<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    //use SoftDeletes;

    public function Category(){
    	return $this->belongsTo('App\Category');
    }
}
