<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model
{
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