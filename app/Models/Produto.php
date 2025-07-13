<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco_custo',
        'estoque'
    ];

    protected $casts = [
        'preco_custo' => 'decimal:2',
    ];

    public function fornecedores()
    {
        return $this->belongsToMany(Fornecedor::class, 'produto_fornecedor');
    }

    public function itensCompra()
    {
        return $this->hasMany(ItemCompra::class);
    }

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
