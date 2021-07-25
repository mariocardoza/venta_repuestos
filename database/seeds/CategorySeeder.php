<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Category::all()->count() < 1){
            $sql = database_path('marcas.sql');
            DB::unprepared(file_get_contents($sql));
        }
    }
}
