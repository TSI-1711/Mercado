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
    
    // ... adicione outros relacionamentos se necessário (item_orcamento, item_entrada)
}
