<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrcamento extends Model
{
    protected $fillable = [
        'orcamento_id',
        'produto_id',
        'quantidade',
        'preco_unitario'
    ];

    // Um item de orçamento pertence a um orçamento
    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class);
    }

    // Um item de orçamento refere-se a um produto
    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
