<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function itens()
    {
        return $this->hasMany(ItemCompra::class);
    }
    
    public function entradas()
    {
        return $this->hasMany(Entrada::class);
    }
    
    public function orcamento()
    {
        return $this->belongsTo(Orcamento::class);
    }
    
    protected $fillable = [
        'fornecedor_id',
        'data_compra',
        'valor_total',
        'status'
    ];
}