<?php

namespace App\Http\Controllers;

use App\Models\ContasPagar;
use App\Models\Compra;
use App\Models\TipoDespesa;
use Illuminate\Http\Request;

class ContasPagarController extends Controller
{
    public function index()
    {
        $contas = ContasPagar::with(['compra', 'tipoDespesa'])->get();
        return view('contas_pagar.index', compact('contas'));
    }

    public function create()
    {
        $compras = Compra::all();
        $tipos = TipoDespesa::all();
        return view('contas_pagar.create', compact('compras', 'tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'compra_id' => 'nullable|exists:compra,id',
            'tipo_despesa_id' => 'required|exists:tipo_despesa,id',
            'data_vencimento' => 'required|date',
            'valor' => 'required|numeric',
        ]);

        ContasPagar::create($request->all());
        return redirect()->route('contas_pagar.index')->with('success', 'Conta a pagar cadastrada com sucesso.');
    }

    public function edit(ContasPagar $contas_pagar)
    {
        $compras = Compra::all();
        $tipos = TipoDespesa::all();
        return view('contas_pagar.edit', compact('contas_pagar', 'compras', 'tipos'));
    }

    public function update(Request $request, ContasPagar $contas_pagar)
    {
        $request->validate([
            'compra_id' => 'nullable|exists:compra,id',
            'tipo_despesa_id' => 'required|exists:tipo_despesa,id',
            'data_vencimento' => 'required|date',
            'valor' => 'required|numeric',
        ]);

        $contas_pagar->update($request->all());
        return redirect()->route('contas_pagar.index')->with('success', 'Conta a pagar atualizada com sucesso.');
    }

    public function destroy(ContasPagar $contas_pagar)
    {
        $contas_pagar->delete();
        return redirect()->route('contas_pagar.index')->with('success', 'Conta a pagar excluída.');
    }
}