<?php

namespace JordanPartridge\LaraBikes\Database\Factories;

use JordanPartridge\LaraBikes\Models\StravaClient;
use Illuminate\Database\Eloquent\Factories\Factory;
class StravaClientFactory extends Factory
{
    protected $model = StravaClient::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 100),
            'athlete_id'    => $this->faker->numberBetween(1, 100),
            'client_id'     => $this->faker->uuid(),
            'client_secret' => $this->faker->uuid(),
        ];
    }
}
