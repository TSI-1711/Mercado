<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedors';

    protected $fillable = ['nome', 'cnpj', 'endereco', 'telefone', 'email',];

    public function compras()
    {
        return $this->hasMany(Compra::class, 'fornecedor_id');
    }
}
