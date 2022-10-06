<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Backend\User;
use App\Models\Backend\UserSetting;

class UserSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'theme' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'language' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'autologin' => $this->faker->boolean,
        ];
    }
}
