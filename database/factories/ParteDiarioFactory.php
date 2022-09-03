<?php

namespace Database\Factories;

use App\Helper;
use App\ParteDiario;
use Illuminate\Database\Eloquent\Factories\Factory;


class ParteDiarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ParteDiario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $horaEntrada =  $this->faker->time('H:i' , '22:00');
        $horaSalida = $this->faker->time('H:i' , '14:00');

        return [
            'userId' => $this->faker->numberBetween(1,2),
            'fecha' => $this->faker->dateTimeInInterval('0 years','- 360 days'),
            'HoraEntrada' => $horaEntrada,
            'HoraSalida' => $horaSalida,
            'TotalHoras' => Helper::calcularTotalHoras($horaEntrada,$horaSalida),
            'almuerzo' => 0,
            'comida'  => 0,
            'merienda'  => 0,
        ];
    }
}
