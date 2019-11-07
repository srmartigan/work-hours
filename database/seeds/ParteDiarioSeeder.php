<?php

use Illuminate\Database\Seeder;
use App\ParteDiario;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class ParteDiarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(ParteDiario::class,50)->create();
    }
}
