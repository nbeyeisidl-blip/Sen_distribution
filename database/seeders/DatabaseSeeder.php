<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        
    $this->call([
        ProductSeeder::class,
    ]);

        // 1. Appels des autres Seeders
        $this->call([
            AdminUserSeeder::class,
        ]);

        // 2. Création directe de l'utilisateur de test
        User::create([
            'name'     => 'Client Test',
            'email'    => 'c@gmail.com.com',
            'password' => Hash::make('12345678'),
            'role' => 'client',
        ]);
    }
}