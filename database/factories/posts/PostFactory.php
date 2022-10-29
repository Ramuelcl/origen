<?php

namespace Database\Factories\posts;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\posts\Post;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'contenido' => $this->faker->text,
            'publicado' => $this->faker->dateTime(),
            'actualizado' => $this->faker->dateTime(),
        ];
    }
}
