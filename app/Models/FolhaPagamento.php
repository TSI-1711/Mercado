<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolhaPagamento extends Model
{
        use HasFactory;

    protected $fillable = [
        'funcionario_id',
        'mes_referencia',
        'salario_base',
        'total_proventos',
        'total_descontos',
        'salario_bruto',
        'inss',
        'irrf',
        'fgts',
        'salario_liquido',
        'data_geracao',
        'data_pagamento',
        'status',
        'observacoes'
    ];

    protected $casts = [
        'salario_base' => 'decimal:2',
        'total_proventos' => 'decimal:2',
        'total_descontos' => 'decimal:2',
        'salario_bruto' => 'decimal:2',
        'inss' => 'decimal:2',
        'irrf' => 'decimal:2',
        'fgts' => 'decimal:2',
        'salario_liquido' => 'decimal:2',
        'data_geracao' => 'date',
        'data_pagamento' => 'date'
    ];

    const STATUS = [
        'gerada' => 'Gerada',
        'paga' => 'Paga',
        'cancelada' => 'Cancelada'
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencias::class);
    }

}
