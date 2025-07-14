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
    Schema::create('compras', function (Blueprint $table) {
        $table->id();
        $table->foreignId('fornecedor_id')->nullable()->constrained('fornecedors')->onDelete('set null');
        $table->date('data_compra');
        $table->date('data_vencimento');
        $table->string('descricao');
        $table->decimal('valor_total', 10, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
