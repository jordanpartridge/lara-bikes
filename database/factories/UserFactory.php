<?php

namespace JordanPartridge\LaraBikes\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use JordanPartridge\LaraBikes\Tests\User;

class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' =>  bcrypt(Str::uuid()), // password
            'remember_token' => \Illuminate\Support\Str::random(10),
        ];
    }
}
