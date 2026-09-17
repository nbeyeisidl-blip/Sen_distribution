<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Remplacez 'commandes' par le nom exact de votre table si besoin ('orders' ou 'commandes')
        Schema::table('commandes', function (Blueprint $table) {
            if (!Schema::hasColumn('commandes', 'remise')) {
                $table->decimal('remise', 10, 2)->default(0)->after('total');
            }
        });
    }

    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn('remise');
        });
    }
};