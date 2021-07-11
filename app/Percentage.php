<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Percentage extends Model
{
    public static function retornar_porcentaje($dato)
    {
        $porcentajes=Percentage::where('nombre_simple',$dato)->first();
        $valor=0;
        $valor=$porcentajes->porcentaje/100;
        return $valor;
    }
}
