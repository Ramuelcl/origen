<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\backend\Tabla;

class TablaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tabla::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tabla' => $this->faker->numberBetween(-100000, 100000),
            'tabla_id' => $this->faker->numberBetween(-100000, 100000),
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'descripcion' => $this->faker->regexify('[A-Za-z0-9]{128}'),
            'valor1' => $this->faker->randomFloat(2, 0, 999999.99),
            'valor2' => $this->faker->regexify('[A-Za-z0-9]{128}'),
            'valor3' => $this->faker->boolean,
        ];
    }
}
