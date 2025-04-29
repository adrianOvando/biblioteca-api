<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'sexo' => $this->faker->randomElement(['hombre', 'mujer']),
            'correo' => $this->faker->unique()->safeEmail(),
            'celular' => $this->faker->phoneNumber(),
        ];
    }
}
