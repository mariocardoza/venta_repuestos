<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::all()->count() < 1){
          $user1 = Role::create([
            'name' => 'Super Administrador'
          ]);
          $user2 = Role::create([
            'name' => 'Administrador'
          ]);
          $user3 = Role::create([
            'name' => 'Vendedor'
          ]);
        }
    }
}
