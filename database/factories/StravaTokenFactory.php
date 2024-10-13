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
            'access_token' => $this->faker->sha256,
            'expires_at' => $this->faker->dateTimeBetween('now', '+1 hour'),
            'refresh_token' => $this->faker->sha256,
            'athlete_id' => $this->faker->numberBetween(1, 10),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
