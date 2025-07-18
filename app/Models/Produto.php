<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    // Relação N:N com Fornecedor
    public function fornecedores()
    {
        return $this->belongsToMany(Fornecedor::class, 'produto_fornecedor');
    }

    // Um produto pode estar em muitos itens de compra
    public function itensCompra()
    {
        return $this->hasMany(ItemCompra::class);
    }
    
    // Um produto pode estar em muitos itens de orçamento
    public function itensOrcamento()
    {
        return $this->hasMany(ItemOrcamento::class);
    }
    
    // Um produto pode estar em muitos itens de entrada
    public function itensEntrada()
    {
        return $this->hasMany(ItemEntrada::class);
    }
    
    protected $fillable = [
        'nome',
        'descricao',
        'preco_custo',
        'estoque'
    ];
}
