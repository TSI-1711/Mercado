<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemEntrada extends Model
{
    // Um item de entrada pertence a uma entrada
    public function entrada()
    {
        return $this->belongsTo(Entrada::class);
    }

    // Um item de entrada refere-se a um produto
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
