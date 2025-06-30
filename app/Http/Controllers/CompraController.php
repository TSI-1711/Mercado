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
            'fornecedor_id' => 'required|exists:fornecedor,id',
            'data' => 'required|date',
            'descricao' => 'required|string|max:255',
            'valor_total' => 'required|numeric',
        ]);

        Compra::create($request->all());
        return redirect()->route('compra.index')->with('success', 'Compra cadastrada com sucesso.');
    }

    public function edit(Compra $compra)
    {
        $fornecedores = Fornecedor::all();
        return view('compra.edit', compact('compra', 'fornecedores'));
    }

    public function update(Request $request, Compra $compra)
    {
        $request->validate([
            'fornecedor_id' => 'required|exists:fornecedor,id',
            'data' => 'required|date',
            'descricao' => 'required|string|max:255',
            'valor_total' => 'required|numeric',
        ]);

        $compra->update($request->all());
        return redirect()->route('compra.index')->with('success', 'Compra atualizada com sucesso.');
    }

    public function destroy(Compra $compra)
    {
        $compra->delete();
        return redirect()->route('compra.index')->with('success', 'Compra excluída.');
    }
}