<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Helper;
use App\ParteDiario;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(ParteDiario::class, function (Faker $faker) {
    $horaEntrada =  $faker->time('H:i' , '22:00');
    $horaSalida = $faker->time('H:i' , '14:00');

    return [
        'userId' => $faker->numberBetween(0,9),
        'fecha' => $faker->date(),
        'HoraEntrada' => $horaEntrada,
        'HoraSalida' => $horaSalida,
        'TotalHoras' => Helper::calcularTotalHoras($horaEntrada,$horaSalida),
        'almuerzo' => null,
        'comida'  => null,
        'merienda'  => null,

    ];
});

