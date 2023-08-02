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
            'name' => 'Joao',
            'email' => 'joao@example.com',
            'password'=> 'password',
            'telefone'=> '021999999',
            'cidade'=> 'Duque de Caxias',
            'estado'=> 'Rio de Janeiro',
        ]);
    }
}
