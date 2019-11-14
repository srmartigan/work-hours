<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\ParteDiario;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ParteDiario::class, function (Faker $faker) {
    return [
        'userId' => $faker->numberBetween(0,9),
        'dia' => $faker->numberBetween(1,28),
        'mes' => $faker->month,
        'year' =>  $faker->numberBetween(2018,2019),
        'HoraEntrada' => $faker->time('H:i' , '22:00'),
        'HoraSalida' => $faker->time('H:i' , '14:00'),
        'TotalHoras' => '',

    ];
});

