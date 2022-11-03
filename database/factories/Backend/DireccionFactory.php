<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\backend\Ciudad;
use App\Models\backend\Direccion;

class DireccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Direccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'numero' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'calle' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'codPostal' => $this->faker->regexify('[A-Za-z0-9]{6}'),
            'ciudad_id' => Ciudad::factory(),
        ];
    }
}
