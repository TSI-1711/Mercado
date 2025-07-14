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
        Schema::table('folha_pagamentos', function (Blueprint $table) {
            $table->decimal('salario_bruto', 10, 2)->default(0)->change();
            $table->decimal('inss', 10, 2)->default(0)->change();
            $table->decimal('irrf', 10, 2)->default(0)->change();
            $table->decimal('fgts', 10, 2)->default(0)->change();
            $table->decimal('salario_liquido', 10, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('folha_pagamentos', function (Blueprint $table) {
            $table->decimal('salario_bruto', 10, 2)->change();
            $table->decimal('inss', 10, 2)->change();
            $table->decimal('irrf', 10, 2)->change();
            $table->decimal('fgts', 10, 2)->change();
            $table->decimal('salario_liquido', 10, 2)->change();
        });
    }
};
