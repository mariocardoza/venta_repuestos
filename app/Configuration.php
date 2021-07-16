<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Configuration extends Model
{
    protected $guarded = [];

    public function getUrlLogoAttribute(){
        return \Storage::url($this->logo);
    }
}
