<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Correction de l'importation DB
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Vider la table des produits avant l'insertion pour éviter les conflits
        DB::table('products')->delete();

        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'dior',
                'description' => 'çéuihjfgdrz',
                'price' => 20000.00,
                'stock' => 20,
                'category_id' => null,
                'image' => '1789344263_6aa73a07b7dae.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Chessure',
                'description' => 'esxrfchgnh',
                'price' => 10000.00,
                'stock' => 20,
                'category_id' => null,
                'image' => '1789344176_6aa7390bfb34.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 1. Appel du seeder Admin
        $this->call([
            AdminUserSeeder::class,
        ]);

        // 2. Création de l'utilisateur client
        User::updateOrCreate(
            ['email' => 'c@gmail.com'],
            [
                'name' => 'Client Test',
                'password' => Hash::make('12345678'),
                'role' => 'client',
            ]
        );
    }
}