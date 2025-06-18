<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'rg',
        'data_nascimento',
        'endereco',
        'telefone',
        'email',
        'cargo',
        'salario_base',
        'valor_hora_extra',
        'banco',
        'agencia',
        'conta',
        'data_admissao',
        'ativo'
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_admissao' => 'date',
        'ativo' => 'boolean',
        'salario_base' => 'decimal:2',
        'valor_hora_extra' => 'decimal:2'
    ];

    public function ocorrencias()
    {
        return $this->hasMany(Ocorrencias::class);
    }

    public function folhasPagamento()
    {
        return $this->hasMany(FolhaPagamento::class);
    }
}
