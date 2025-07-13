<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    
    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'cpf_cnpj',
        'endereco',
        'cidade',
        'estado',
        'cep',
        'observacoes',
        'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
} 