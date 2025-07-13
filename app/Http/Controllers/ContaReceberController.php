<?php

namespace App\Http\Controllers;

use App\Models\ContaReceber;
use Illuminate\Http\Request;

class ContaReceberController extends Controller
{
    public function index()
    {
        $contas = ContaReceber::all();
        return view('contas_receber.index', compact('contas'));
    }
    public function baixa($id)
    {
        $conta = ContaReceber::findOrFail($id);
        $conta->status = 'recebido';
        $conta->save();

        return redirect()->route('contas-receber.index')->with('success', 'Conta baixada com sucesso!');
    }
    public function vencidas()
{
    $hoje = now()->toDateString();
    $contas = ContaReceber::where('data_vencimento', '<', $hoje)
        ->where('status', '!=', 'recebido')
        ->get();

    return view('contas_receber.contasCencidas', compact('contas'));
}

}
