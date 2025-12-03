<?php
// database/migrations/2025_12_03_000002_create_books_table.php
// Pastikan timestamp ini lebih besar dari create_categories_table.

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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            // Idiomatik Laravel: foreignId + constrained
            $table->foreignId('category_id')
                  ->nullable() // kategori opsional; hilangkan ->nullable() kalau wajib
                  ->constrained('categories')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->string('title', 150);
            $table->string('author', 100);
            $table->decimal('price', 12, 2)->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->string('cover_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
