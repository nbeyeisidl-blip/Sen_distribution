<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'nom' => 'Produit 1',
                'description' => 'Description du produit 1',
                'prix' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Produit 2',
                'description' => 'Description du produit 2',
                'prix' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}