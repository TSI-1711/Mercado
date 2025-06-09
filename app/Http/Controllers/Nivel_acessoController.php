<?php

namespace App\Http\Controllers;

use App\Models\Nivel_acesso;
use Illuminate\Http\Request;


class Nivel_acessoController extends Controller
{
    function listar() {
        $niveis = Nivel_acesso::all();
        foreach($niveis as $nivel) {
            echo "<p> {$nivel->descricao} </p>";
        }
    }

}
