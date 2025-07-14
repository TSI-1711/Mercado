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
            $table->decimal('total_proventos', 10, 2)->default(0)->after('salario_base');
            $table->decimal('total_descontos', 10, 2)->default(0)->after('total_proventos');
            $table->text('observacoes')->nullable()->after('salario_liquido');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('folha_pagamentos', function (Blueprint $table) {
            $table->dropColumn(['total_proventos', 'total_descontos', 'observacoes']);
        });
    }
};
