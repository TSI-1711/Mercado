<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model
{
    protected $fillable = [
        'compra_id',
        'produto_id',
        'quantidade',
        'preco_unitario'
    ];

    // Um item de compra pertence a uma compra
    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    // Um item de compra refere-se a um produto
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}