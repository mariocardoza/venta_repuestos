<?php

use Illuminate\Database\Seeder;
use App\Subcategory;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Subcategory::all()->count() < 1){
            $sql = database_path('modelos.sql');
            DB::unprepared(file_get_contents($sql));
        }
    }
}
