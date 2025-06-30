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
        Schema::create('contas_pagars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compra_id')->nullable();
            $table->unsignedBigInteger('tipo_despesa_id');
            $table->date('data_vencimento');
            $table->decimal('valor', 10, 2);
            $table->boolean('pago')->default(false);
            $table->timestamps();

            $table->foreign('compra_id')->references('id')->on('compra')->onDelete('set null');
            $table->foreign('tipo_despesa_id')->references('id')->on('tipo_despesa')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_pagars');
    }
};
