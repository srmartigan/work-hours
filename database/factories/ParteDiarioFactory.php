<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\ParteDiario;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ParteDiario::class, function (Faker $faker) {
    return [
        'userId' => $faker->numberBetween(0,9),
        'fecha' => $faker->date(),
        'HoraEntrada' => $faker->time('H:i' , '22:00'),
        'HoraSalida' => $faker->time('H:i' , '14:00'),
        'TotalHoras' => '',
        'almuerzo' => null,
        'comida'  => null,
        'merienda'  => null,

    ];
});

