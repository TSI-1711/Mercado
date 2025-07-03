<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model
{
    // Um orçamento pertence a um fornecedor
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    // Um orçamento tem muitos itens
    public function itens()
    {
        return $this->hasMany(ItemOrcamento::class);
    }
}
