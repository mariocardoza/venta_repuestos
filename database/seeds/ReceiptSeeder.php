<?php

use Illuminate\Database\Seeder;
use App\Receipt;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Receipt::all()->count() < 1){
            $por= new Receipt();
            $por->name='Recibo';
            $por->save();

            $por= new Receipt();
            $por->name='Consumidor Final';
            $por->save();

            $por= new Receipt();
            $por->name='Crédito Fiscal';            
            $por->save();
        }
    }
}
