<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Compra;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::with('compra.fornecedor')->latest()->paginate(10);
        return view('entradas.index', compact('entradas'));
    }

    /**
     * Mostra o formulário para criar uma entrada.
     * Se receber compra_id, mostra a entrada para uma compra específica.
     * Caso contrário, mostra a lista de compras disponíveis.
     */
    public function create(Request $request)
    {
        if ($request->has('compra_id')) {
            $compra = Compra::with('itens.produto')->findOrFail($request->query('compra_id'));
            return view('entradas.create', compact('compra'));
        } else {
            $compras = Compra::with('fornecedor')->where('status', '!=', 'recebido')->get();
            return view('entradas.create', compact('compras'));
        }
    }

    /**
     * Salva a entrada e ATUALIZA O ESTOQUE dos produtos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'compra_id' => 'required|exists:compras,id',
            'data_entrada' => 'required|date',
            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade_recebida' => 'required|integer|min:0',
        ]);

        try {
            DB::beginTransaction();

            // 1. Cria o registro da Entrada
            $entrada = Entrada::create([
                'compra_id' => $request->compra_id,
                'data_entrada' => $request->data_entrada,
                'observacoes' => $request->observacoes,
            ]);

            // 2. Cria os itens da entrada e atualiza o estoque de cada produto
            foreach ($request->itens as $itemData) {
                // Salva o item na entrada
                $entrada->itens()->create($itemData);

                // ATUALIZA O ESTOQUE DO PRODUTO (Lógica principal)
                $produto = Produto::find($itemData['produto_id']);
                $produto->estoque += $itemData['quantidade_recebida'];
                $produto->save();
                // Ou de forma atômica: $produto->increment('estoque', $itemData['quantidade_recebida']);
            }

            // 3. Atualiza o status da compra para "Recebido"
            $compra = Compra::find($request->compra_id);
            $compra->status = 'recebido';
            $compra->save();

            DB::commit();
            return redirect()->route('entradas.index')->with('success', 'Entrada de produtos registrada e estoque atualizado!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao registrar entrada: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Entrada $entrada)
    {
        $entrada->load('compra.fornecedor', 'itens.produto');
        return view('entradas.show', compact('entrada'));
    }

    public function edit(Entrada $entrada)
    {
        $entrada->load('compra.fornecedor', 'itens.produto');
        return view('entradas.edit', compact('entrada'));
    }

    public function update(Request $request, Entrada $entrada)
    {
        $request->validate([
            'data_entrada' => 'required|date',
            'observacoes' => 'nullable|string',
        ]);

        $entrada->update($request->only(['data_entrada', 'observacoes']));

        return redirect()->route('entradas.show', $entrada->id)->with('success', 'Entrada atualizada com sucesso.');
    }

    public function destroy(Entrada $entrada)
    {
        try {
            DB::beginTransaction();

            // Reverte o estoque dos produtos
            foreach ($entrada->itens as $item) {
                $produto = Produto::find($item->produto_id);
                $produto->estoque -= $item->quantidade_recebida;
                $produto->save();
            }

            // Remove os itens da entrada
            $entrada->itens()->delete();
            
            // Remove a entrada
            $entrada->delete();

            // Atualiza o status da compra para "em_aberto"
            $compra = Compra::find($entrada->compra_id);
            $compra->status = 'em_aberto';
            $compra->save();

            DB::commit();
            return redirect()->route('entradas.index')->with('success', 'Entrada excluída com sucesso.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('entradas.index')->with('error', 'Erro ao excluir entrada: ' . $e->getMessage());
        }
    }
}