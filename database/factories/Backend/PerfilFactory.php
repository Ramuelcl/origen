<?php

namespace Database\Factories\backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\backend\Perfil;

class PerfilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Perfil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $edad = $this->faker->numberBetween($min = 18, $max = 65);
        //randomNumber($nbDigits = 2, $strict = false),
        $profesion = ucwords($this->faker->words($this->faker->numberBetween(1, 2), $string = true));
        $biografia = ucwords($this->faker->words($this->faker->numberBetween(10, 93), $string = true));

        return [
            // 'user_id' => $this->id,
            'edad' => $edad,
            'profesion' => $profesion,
            'biografia' => $biografia,
            'website' => $this->faker->url(),
        ];
    }
}
