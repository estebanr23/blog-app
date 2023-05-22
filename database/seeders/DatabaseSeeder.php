<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(2)->create();

        \App\Models\User::factory()->create([
            'email' => 'esteban@correo.com',
            'password' => Hash::make('123456'),
        ]);

        \App\Models\Area::factory(5)->create();
        \App\Models\Article::factory(10)->create();
    }
}
