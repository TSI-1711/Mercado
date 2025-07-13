<?php

namespace App\Http\Controllers;

use App\Models\ContaReceber;
use Illuminate\Http\Request;

class ContaReceberController extends Controller
{
    // Tela de contas recebidas (pagas)
    public function recebidas()
    {
        $contas = ContaReceber::where('status', 'recebido')->get();
        return view('contas_receber.recebidas', compact('contas'));
    }

    // Tela de contas vencidas (não pagas)
    public function vencidas()
    {
        $hoje = now()->toDateString();
        $contas = ContaReceber::where(function ($query) use ($hoje) {
            $query->where('data_vencimento', '<', $hoje)
                  ->orWhere('status', 'vencido');
        })->where('status', '!=', 'recebido')->get();

        return view('contas_receber.vencidas', compact('contas'));
    }

    // Tela de pagamento da conta
    public function pagamento($id)
    {
        $conta = ContaReceber::findOrFail($id);
        return view('contas_receber.pagamento', compact('conta'));
    }

    // Confirmação do pagamento (simulação)
    public function confirmarPagamento(Request $request, $id)
    {
        $conta = ContaReceber::findOrFail($id);
        $conta->status = 'recebido';
        $conta->save();

        return redirect()->route('contas-receber.recebidas')->with('success', 'Pagamento realizado com sucesso!');
    }

    // Marca a conta como vencida (usado pelo JS)
    public function marcarComoVencida(Request $request, $id)
    {
        $conta = ContaReceber::findOrFail($id);
        if ($conta->status === 'aberto') {
            $conta->status = 'vencido';
            $conta->save();
            return response()->json(['success' => true, 'message' => 'Conta marcada como vencida.']);
        }
        return response()->json(['success' => false, 'message' => 'A conta não pôde ser marcada como vencida.'], 400);
    }
}
