<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('contas_pagar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folha_pagamento_id')->nullable();
            $table->string('descricao');
            $table->decimal('valor', 10, 2);
            $table->date('data_vencimento');
            $table->date('data_pagamento')->nullable();
            $table->enum('status', ['pendente', 'paga', 'cancelada'])->default('pendente');
            $table->text('observacao')->nullable();
            $table->timestamps();

            $table->foreign('folha_pagamento_id')
                  ->references('id')
                  ->on('folha_pagamentos')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas_a_pagars');
    }
};
