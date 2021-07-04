<?php

use Illuminate\Database\Seeder;
use App\Percentage;

class PercentageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Percentage::all()->count() < 1){
            $por= new Percentage();
            $por->nombre='Renta';
            $por->nombre_simple='renta';
            $por->porcentaje=10;
            $por->save();

            $por= new Percentage();
            $por->nombre='IVA';
            $por->nombre_simple='iva';
            $por->porcentaje=13;
            $por->save();

            $por= new Percentage();
            $por->nombre='IVA Retenido';
            $por->nombre_simple='ivar';
            $por->porcentaje=1;
            $por->save();
        }
    }
}
