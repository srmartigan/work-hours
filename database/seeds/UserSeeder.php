<?php

use App\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' =>hash('sha256' ,'1234')
        ]);
        DB::table('Users')->insert([
            'name' => 'lolo',
            'email' => 'lolo@admin.com',
            'password' =>hash ('sha256' ,'1234')
        ]);

        $users = User::all();

        foreach ($users as $user) {
            DB::table('configuracion_usuarios')->insert([
                'userId' => $user->id,
                'descuento_almuerzo' => 0,
                'descuento_comida' => 0,
                'descuento_merienda' => 0
            ]);
        }
    }
}
