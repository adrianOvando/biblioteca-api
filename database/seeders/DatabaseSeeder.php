<?php

namespace Database\Seeders;

use App\Models\Lector;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        
        // User::factory(10)->create();

            // Usuario administrador con contraseña explícita
    User::factory()->create([
        'nombre' => 'Administrador',  // Corregido el typo
        'email' => 'admin@sis258.com',
        'password' => Hash::make('password'),  // Contraseña explícita
        'rol' => 'administrador'  // Asignar rol explícitamente
    ]);

    User::factory(10)->create(['rol' => 'usuario'])->each(function ($user) {
        Lector::create([
            'user_id' => $user->id,
            'apellidos' => fake()->lastName . ' ' . fake()->lastName, // Ej: "Pérez López"
            'sexo' => fake()->randomElement(['hombre', 'mujer']),
            'celular' => fake()->phoneNumber
        ]);
    });


    // Primero crea el User
    $user = User::create([
        'nombre' => 'Juan',
        'email' => 'juan@email.com',
        'password' => Hash::make('password'),
        'rol' => 'usuario'
    ]);

    // Luego el Lector asociado
    Lector::create([
        'user_id' => $user->id,
        'apellidos' => 'Pérez López',
        'sexo' => 'hombre',
        'celular' => '7771234567'
    ]);

    // Resto de usuarios
    User::factory(10)->create();
        User::factory(10)->create();
        $this->call([
            LibroSeeder::class
        ]);

        $this->call([
            LectorSeeder::class
        ]);
    }


    
}