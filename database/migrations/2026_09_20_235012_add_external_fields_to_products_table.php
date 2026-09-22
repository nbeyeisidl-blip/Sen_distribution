<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'external_source')) {
                $table->string('external_source')->nullable()->after('category_id');
            }
            if (!Schema::hasColumn('products', 'external_ref')) {
                $table->string('external_ref')->nullable()->after('external_source');
            }
            if (!Schema::hasColumn('products', 'size')) {
                $table->string('size')->nullable()->after('external_ref');
            }
            if (!Schema::hasColumn('products', 'color')) {
                $table->string('color')->nullable()->after('size');
            }
            if (!Schema::hasColumn('products', 'gender')) {
                $table->enum('gender', ['homme', 'femme', 'mixte', 'enfant'])->default('mixte')->after('color');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['external_source', 'external_ref', 'size', 'color', 'gender']);
        });
    }
};