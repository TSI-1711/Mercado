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
        Schema::create('item_entradas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('entrada_id')->constrained('entradas')->onDelete('cascade');
    $table->foreignId('produto_id')->constrained('produtos');
    $table->integer('quantidade_recebida');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_entradas');
    }
};
