<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::all()->count() < 1){
          // Usuario administrador
          $user_admin2 = User::create([
            'name' => 'Super admin',
            'email' => 'mariokr.rocker@gmail.com',
            'phone' => '+50372035869',
            'password' => Hash::make('awesome'),
            'role_id' => 1
          ]);

          // Usuario tipo emprendedor
          $user1 = User::create([
            'name' => 'Administrador',
            'email' => 'dya_re@hotmail.com',
            'phone' => '+50372035861',
            'password' => Hash::make('awesome'),
            'role_id' => 2
          ]);

          // Usuario tipo cliente
          $user1 = User::create([
            'name' => 'Vendedor',
            'email' => 'mario@influenciadigital.net',
            'phone' => '+50372035819',
            'password' => Hash::make('awesome'),
            'role_id' => 3
          ]);
        }
    }
}
