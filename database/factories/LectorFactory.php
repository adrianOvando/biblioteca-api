<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lector>
 */
class LectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), 
            'apellidos' => $this->faker->lastName(),
            'sexo' => $this->faker->randomElement(['hombre', 'mujer']),
            'celular' => $this->faker->phoneNumber(),
        ];
    }
}
