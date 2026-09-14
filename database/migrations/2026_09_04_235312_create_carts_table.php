<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            
            // Relation avec l'utilisateur (Users)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Relation avec le produit
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            
            // Quantité et prix unitaire
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};