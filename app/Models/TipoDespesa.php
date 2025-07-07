<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDespesa extends Model
{
    use HasFactory;

    /**
     * Nome da tabela associada ao modelo
     * 
     * @var string
     */
    protected $table = 'tipo_despesas';

    /**
     * Atributos que podem ser preenchidos em massa
     * 
     * @var array
     */
    protected $fillable = [
        'nome'
    ];

    /**
     * Atributos que devem ser convertidos para tipos nativos
     * 
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relacionamento com ContasPagar
     * Um tipo de despesa pode estar em muitas contas a pagar
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contasPagar()
    {
        return $this->hasMany(ContasPagar::class, 'tipo_despesa_id');
    }

    /**
     * Escopo para ordenação padrão por nome
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdenarPorNome($query)
    {
        return $query->orderBy('nome');
    }

    /**
     * Acessor para nome em maiúsculas
     * 
     * @return string
     */
    public function getNomeMaiusculoAttribute()
    {
        return mb_strtoupper($this->nome);
    }

    /**
     * Mutator para garantir nome sem espaços extras
     * 
     * @param string $value
     * @return void
     */
    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = trim($value);
    }
}