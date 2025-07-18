<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;
    protected $table = 'fornecedores';

    protected $fillable = [
        'nome',
        'cnpj',
        'telefone',
        'endereco',
        'email',
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'produto_fornecedor');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function orcamentos()
    {
        return $this->hasMany(Orcamento::class);
    }
}
