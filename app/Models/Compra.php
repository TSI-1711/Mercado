<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compra extends Model
{
    use HasFactory;


    protected $casts = [
        'data_compra' => 'datetime:Y-m-d',
        'data_vencimento' => 'datetime:Y-m-d',
        'valor_total' => 'decimal:2'
    ];

    
    protected $fillable = [
        'fornecedor_id',
        'data_compra',
        'data_vencimento',
        'descricao',
        'valor_total',
    ];
    
    public function getDataCompraAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function getDataVencimentoAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    
}