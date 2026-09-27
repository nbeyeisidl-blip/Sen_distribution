<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::table('products', function (Blueprint $table) {
        if (!Schema::hasColumn('products', 'size')) {
            $table->string('size')->nullable(); // Adaptez le type de données selon votre migration originale
        }
        // Faites de même si d'autres colonnes de cette migration posent problème
    });
}

public function down(): void
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['size', 'color', 'gender']);
    });
}
};
