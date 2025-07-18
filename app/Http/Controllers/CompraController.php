<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with('fornecedor')->latest()->paginate(10);
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::all();
        $produtos = Produto::all();
        return view('compras.create', compact('fornecedores', 'produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'data_compra' => 'required|date',
            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.preco_unitario' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $compra = new Compra();
            $compra->fornecedor_id = $request->fornecedor_id;
            $compra->data_compra = $request->data_compra;
            $compra->status = 'em_aberto';

            $valorTotal = 0;
            foreach ($request->itens as $itemData) {
                $valorTotal += $itemData['quantidade'] * $itemData['preco_unitario'];
            }
            $compra->valor_total = $valorTotal;
            $compra->save();

            // Salva os itens associados à compra
            $compra->itens()->createMany($request->itens);
            
            DB::commit();
            return redirect()->route('compras.index')->with('success', 'Ordem de Compra criada com sucesso.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao criar Ordem de Compra: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Compra $compra)
    {
        $compra->load('fornecedor', 'itens.produto');
        return view('compras.show', compact('compra'));
    }

    public function edit(Compra $compra)
    {
        $fornecedores = Fornecedor::all();
        $produtos = Produto::all();
        $compra->load('itens.produto');
        return view('compras.edit', compact('compra', 'fornecedores', 'produtos'));
    }

    public function update(Request $request, Compra $compra)
    {
        $request->validate([
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'data_compra' => 'required|date',
            'status' => 'required|in:em_aberto,recebido,cancelado',
        ]);

        $compra->update($request->only(['fornecedor_id', 'data_compra', 'status']));

        return redirect()->route('compras.show', $compra->id)->with('success', 'Ordem de Compra atualizada com sucesso.');
    }

    public function destroy(Compra $compra)
    {
        try {
            $compra->itens()->delete();
            $compra->delete();
            return redirect()->route('compras.index')->with('success', 'Ordem de Compra excluída com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('compras.index')->with('error', 'Erro ao excluir ordem de compra: ' . $e->getMessage());
        }
    }

    public function getItens(Compra $compra)
    {
        $compra->load('itens.produto');
        return response()->json(['itens' => $compra->itens]);
    }
}