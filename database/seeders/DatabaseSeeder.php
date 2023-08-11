<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'carlos',
            // 'cpf' => '1231345',
            'email' => 'carlo@example.com',
            'password' => 'password',
            // 'nascimento' => '2000/05/12',
            'telefone' => '021999999',
            'cidade' => 'Duque de Caxias',
            'estado' => 'Rio de Janeiro',
        ]);
    }
}
