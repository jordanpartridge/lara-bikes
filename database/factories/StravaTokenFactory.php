<?php

namespace JordanPartridge\LaraBikes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use JordanPartridge\LaraBikes\Models\StravaToken;


class StravaTokenFactory extends Factory
{
    protected $model = StravaToken::class;
    public function definition(): array
    {
        return [
            'access_token' => $this->faker->word(),
            'expires_at' => $this->faker->dateTime(),
            'refresh_token' => $this->faker->word(),
        ];
    }
}
