<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ocorrencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcionario_id');
            $table->unsignedBigInteger('folha_pagamento_id')->nullable();
            $table->enum('tipo', ['hora_extra', 'falta', 'atraso', 'outro']);
            $table->date('data');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fim')->nullable();
            $table->decimal('quantidade_horas', 5, 2)->nullable();
            $table->text('descricao')->nullable();
            $table->enum('status', ['pendente', 'aprovada', 'rejeitada', 'processada'])->default('pendente');
            $table->unsignedBigInteger('aprovador_id')->nullable();
            $table->decimal('valor_calculado', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('funcionario_id')
                  ->references('id')
                  ->on('funcionarios')
                  ->onDelete('cascade');
                  
            $table->foreign('aprovador_id')
                  ->references('id')
                  ->on('funcionarios')
                  ->onDelete('set null');
                  
            $table->foreign('folha_pagamento_id')
                  ->references('id')
                  ->on('folha_pagamentos')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ocorrencias');
    }
};