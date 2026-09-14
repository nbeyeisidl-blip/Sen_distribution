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
    Schema::table('orders', function (Blueprint $table) {
        $table->text('address')->nullable()->after('status');
        $table->string('phone', 30)->nullable()->after('address');
        $table->text('notes')->nullable()->after('phone');
    });
}

public function down(): void
{
    if (!Schema::hasColumn('orders', 'phone')) {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('phone')->nullable();
        });
    }

    
};
