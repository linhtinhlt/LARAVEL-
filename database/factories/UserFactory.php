<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'password' => bcrypt('password'), // Mật khẩu mặc định
            'email' => $this->faker->unique()->safeEmail,
            'name' => $this->faker->name,
            'role' => $this->faker->randomElement(['user', 'admin']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
