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
        'userId' => $faker->numberBetween(1,2),
        'fecha' => $faker->dateTimeInInterval('0 years','- 360 days'),
        'HoraEntrada' => $horaEntrada,
        'HoraSalida' => $horaSalida,
        'TotalHoras' => Helper::calcularTotalHoras($horaEntrada,$horaSalida),
        'almuerzo' => 0,
        'comida'  => 0,
        'merienda'  => 0,

    ];
});

