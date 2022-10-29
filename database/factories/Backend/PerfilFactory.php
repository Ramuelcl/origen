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
        return [
            'user_id' => User::factory(),
            'edad' => $this->faker->randomDigitNotNull,
            'profesion' => $this->faker->regexify('[A-Za-z0-9]{30}'),
            'biografia' => $this->faker->text,
            'website' => $this->faker->regexify('[A-Za-z0-9]{45}'),
        ];
    }
}
