<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('folha_pagamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcionario_id');
            $table->string('mes_referencia');
            $table->decimal('salario_base', 10, 2);
            $table->decimal('total_horas_extras', 10, 2)->default(0);
            $table->decimal('valor_horas_extras', 10, 2)->default(0);
            $table->integer('dias_falta')->default(0);
            $table->decimal('desconto_faltas', 10, 2)->default(0);
            $table->decimal('outros_descontos', 10, 2)->default(0);
            $table->text('descricao_descontos')->nullable();
            $table->decimal('outros_acrescimos', 10, 2)->default(0);
            $table->text('descricao_acrescimos')->nullable();
            $table->decimal('salario_bruto', 10, 2);
            $table->decimal('inss', 10, 2);
            $table->decimal('irrf', 10, 2);
            $table->decimal('fgts', 10, 2);
            $table->decimal('salario_liquido', 10, 2);
            $table->date('data_geracao');
            $table->date('data_pagamento')->nullable();
            $table->enum('status', ['gerada', 'paga', 'cancelada'])->default('gerada');
            $table->timestamps();

            $table->foreign('funcionario_id')
                  ->references('id')
                  ->on('funcionarios')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('folha_pagamentos');
    }
};