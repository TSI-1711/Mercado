<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    // Uma entrada pertence a uma compra
    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    // Uma entrada tem muitos itens
    public function itens()
    {
        return $this->hasMany(ItemEntrada::class);
    }
    
    protected $fillable = [
        'compra_id',
        'data_entrada',
        'observacoes'
    ];
}
