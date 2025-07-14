<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with('fornecedor')->get();
        return view('compra.index', compact('compras'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::all();
        return view('compra.create', compact('fornecedores'));

    }

    public function store(Request $request)
{
    $request->validate([
        'fornecedor_id' => 'required|exists:fornecedors,id',
        'data_compra' => 'required|date',
        'data_vencimento' => 'required|date',
        'descricao' => 'required|string|max:255',
        'valor_total' => 'required|numeric',
    ]);

    // Grava os dados explicitamente
    $compra = Compra::create([
        'fornecedor_id' => $request->input('fornecedor_id'),
        'data_compra'    => $request->input('data_compra'),
        'data_vencimento' => $request->input('data_vencimento'),
        'descricao'      => $request->input('descricao'),
        'valor_total'    => $request->input('valor_total'),
    ]);

    // Redireciona com sucesso
    return redirect()->route('compra.index')->with('success', 'Compra cadastrada com sucesso.');
}

public function edit(Compra $compra)
{

    $fornecedores = Fornecedor::all();
    
    // Garante que as datas estejam no formato correto
    $compra->data_compra = $compra->data_compra ?? now()->format('Y-m-d');
    $compra->data_vencimento = $compra->data_vencimento ?? now()->addDays(30)->format('Y-m-d');
    
    return view('compra.edit', compact('compra', 'fornecedores'));
}

    public function update(Request $request, Compra $compra)
    {
        $validated = $request->validate([
            'fornecedor_id' => 'nullable|exists:fornecedors,id',
            'descricao' => 'required|string',
            'data_compra' => 'required|date',
            'data_vencimento' => 'required|date|after_or_equal:data_compra',
            'valor_total' => 'required|numeric|min:0',
        ]);
    
        // Garante a formatação correta antes de salvar
        $validated['data_compra'] = \Carbon\Carbon::parse($validated['data_compra'])->format('Y-m-d');
        $validated['data_vencimento'] = \Carbon\Carbon::parse($validated['data_vencimento'])->format('Y-m-d');
    
        $compra->update($validated);
        
        return redirect()->route('compra.index')->with('success', 'Compra atualizada com sucesso.');
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();

        return redirect()->route('compra.index')->with('success', 'Compra excluída com sucesso.');
    }
}