<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContasPagar extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contas_pagars'; // Explicita o nome da tabela

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'compra_id',
        'tipo_despesa_id',
        'data_vencimento',
        'valor',
        'pago'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data_vencimento' => 'date',
        'valor' => 'decimal:2',
        'pago' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relacionamento com Compra
     */
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    /**
     * Relacionamento com TipoDespesa
     */
    public function tipoDespesa()
    {
        return $this->belongsTo(TipoDespesa::class, 'tipo_despesa_id');
    }

    /**
     * Escopo para contas pagas
     */
    public function scopePagas($query)
    {
        return $query->where('pago', true);
    }

    /**
     * Escopo para contas pendentes
     */
    public function scopePendentes($query)
    {
        return $query->where('pago', false);
    }

    /**
     * Acessor para status formatado
     */
    public function getStatusAttribute()
    {
        return $this->pago ? 'Pago' : 'Pendente';
    }

    /**
     * Acessor para valor formatado
     */
    public function getValorFormatadoAttribute()
    {
        return 'R$ ' . number_format($this->valor, 2, ',', '.');
    }
}