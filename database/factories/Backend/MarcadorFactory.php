<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\backend\Marcador;

class MarcadorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Marcador::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{45}'),
            'slug' => $this->faker->slug,
            'hexa' => $this->faker->regexify('[A-Za-z0-9]{7}'),
            'imagen' => $this->faker->regexify('[A-Za-z0-9]{128}'),
            'rgb' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'metadata' => '{}',
        ];
    }
}
