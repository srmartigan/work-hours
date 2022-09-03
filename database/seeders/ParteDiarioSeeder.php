<?php

/** @var Factory factory */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\ParteDiario;
use Illuminate\Database\Eloquent\Factories\Factory;


class ParteDiarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //factoria de partes diarios
        ParteDiario::factory()->count(100)->create();

    }
}
