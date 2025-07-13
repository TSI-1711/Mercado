<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'vendas';

    protected $fillable = [
        'cliente_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'subtotal',
        'data_venda',
        'valor_total',
        'status',
        'observacoes'
    ];

    protected $casts = [
        'data_venda' => 'date',
        'valor_total' => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function contaReceber()
    {
        return $this->hasOne(ContaReceber::class);
    }
}
