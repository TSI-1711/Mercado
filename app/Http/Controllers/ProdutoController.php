<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('fornecedores')->latest()->paginate(10);
        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco_custo' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
        ]);

        Produto::create($request->all());

        return redirect()->route('produtos.index')->with('success', 'Produto cadastrado com sucesso.');
    }

    public function show(Produto $produto)
    {
        $produto->load('fornecedores');
        return view('produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco_custo' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
        ]);

        $produto->update($request->all());

        return redirect()->route('produtos.show', $produto->id)->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Produto $produto)
    {
        try {
            $produto->delete();
            return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('produtos.index')->with('error', 'Erro ao excluir produto. Verifique se não há registros relacionados.');
        }
    }
}