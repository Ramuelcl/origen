<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\backend\Pais;

class PaisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pais::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'bandera' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'idioma' => $this->faker->regexify('[A-Za-z0-9]{255}'),
        ];
    }
}
