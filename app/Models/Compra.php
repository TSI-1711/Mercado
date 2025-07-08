<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'fornecedor_id',
        'data_compra',
        'descricao',
        'valor_total',
    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}