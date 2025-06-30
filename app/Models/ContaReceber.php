<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    protected $table = 'contas_receber';
    protected $fillable = ['cliente_id', 'valor', 'data_vencimento', 'status'];
}
