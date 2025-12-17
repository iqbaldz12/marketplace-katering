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
Schema::create('menus', function (Blueprint $table) {
    $table->id();
    $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
    $table->string('name');
    $table->text('description');
    $table->string('image')->nullable(); // Path to file
    $table->decimal('price', 10, 2);
    $table->string('category')->nullable(); // e.g., 'Indonesian', 'Western'
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
