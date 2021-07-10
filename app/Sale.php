<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $dates = ['date'];

    public function detail()
    {
        return $this->hasMany('App\Customer');
    }
}
