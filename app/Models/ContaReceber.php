<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    protected $table = 'contas_receber';
    protected $fillable = ['venda_id', 'cliente_id', 'valor', 'data_vencimento', 'status'];
    public function cliente()
{
    return $this->belongsTo(\App\Models\Cliente::class);
}
public function venda() {
    return $this->belongsTo(\App\Models\Venda::class);
}
}


