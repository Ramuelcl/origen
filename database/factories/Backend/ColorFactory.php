<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Backend\Color;

class ColorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Color::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'slut' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'hexa' => $this->faker->regexify('[A-Za-z0-9]{6}'),
            'rgb' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'metadata' => 'null',
        ];
    }
}
