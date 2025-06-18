<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ocorrencias extends Model
{
    use HasFactory;

    protected $fillable = [
        'funcionario_id',
        'folha_pagamento_id',
        'tipo',
        'data',
        'hora_inicio',
        'hora_fim',
        'quantidade_horas',
        'descricao',
        'status',
        'valor_calculado'
    ];

    protected $casts = [
        'data' => 'date',
        'hora_inicio' => 'datetime:H:i',
        'hora_fim' => 'datetime:H:i',
        'quantidade_horas' => 'decimal:2',
        'valor_calculado' => 'decimal:2'
    ];

    const TIPOS = [
        'hora_extra' => 'Hora Extra',
        'falta' => 'Falta',
        'atraso' => 'Atraso',
        'outro' => 'Outro'
    ];

    const STATUS = [
        'pendente' => 'Pendente',
        'aprovada' => 'Aprovada',
        'rejeitada' => 'Rejeitada',
        'processada' => 'Processada'
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function folhaPagamento()
    {
        return $this->belongsTo(FolhaPagamento::class);
    }

    // Método para calcular horas automaticamente
    public function calcularHoras()
    {
        if ($this->hora_inicio && $this->hora_fim) {
            $inicio = \Carbon\Carbon::parse($this->hora_inicio);
            $fim = \Carbon\Carbon::parse($this->hora_fim);
            $this->quantidade_horas = $fim->diffInHours($inicio, true);
        }
        return $this;
    }
}
