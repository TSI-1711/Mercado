<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContasAPagar extends Model
{
    use HasFactory;

    protected $fillable = [
        'folha_pagamento_id',
        'descricao',
        'valor',
        'data_vencimento',
        'data_pagamento',
        'status',
        'observacao'
    ];

    protected $casts = [
        'valor' => 'decimal:2',
        'data_vencimento' => 'date',
        'data_pagamento' => 'date'
    ];

    const STATUS = [
        'pendente' => 'Pendente',
        'paga' => 'Paga',
        'cancelada' => 'Cancelada'
    ];

    public function folhaPagamento()
    {
        return $this->belongsTo(FolhaPagamento::class);
    }
}
