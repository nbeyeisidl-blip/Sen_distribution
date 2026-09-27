<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    if (Schema::hasTable('orders')) {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'remise')) {
                $table->decimal('remise', 10, 2)->default(0)->after('total');
            }
        });
    }
}

    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropColumn('remise');
        });
    }
};