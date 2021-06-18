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

}
