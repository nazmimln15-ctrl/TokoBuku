<?php
// database/migrations/2025_12_03_000001_create_categories_table.php
// Pastikan timestamp file lebih awal dari create_books_table sehingga categories dibuat dulu.

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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            // default NOT NULL. Gunakan ->nullable() bila ingin mengizinkan null.
            $table->string('name', 100)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

