<?php

namespace App\Http\Controllers;

use App\Models\Orcamento;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrcamentoController extends Controller
{
    public function index()
    {
        $orcamentos = Orcamento::with('fornecedor')->latest()->paginate(10);
        return view('orcamentos.index', compact('orcamentos'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::all();
        $produtos = Produto::all();
        return view('orcamentos.create', compact('fornecedores', 'produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'data_orcamento' => 'required|date',
            'itens' => 'required|array|min:1',
            'itens.*.produto_id' => 'required|exists:produtos,id',
            'itens.*.quantidade' => 'required|integer|min:1',
            'itens.*.preco_unitario' => 'required|numeric|min:0',
        ]);

        try {
            DB::beginTransaction();

            $orcamento = Orcamento::create([
                'fornecedor_id' => $request->fornecedor_id,
                'data_orcamento' => $request->data_orcamento,
                'status' => 'pendente',
            ]);

            $valorTotal = 0;
            foreach ($request->itens as $item) {
                $orcamento->itens()->create($item);
                $valorTotal += $item['quantidade'] * $item['preco_unitario'];
            }

            $orcamento->valor_total = $valorTotal;
            $orcamento->save();

            DB::commit();
            return redirect()->route('orcamentos.index')->with('success', 'Orçamento criado com sucesso.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao criar orçamento: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Orcamento $orcamento)
    {
        // O with() carrega os relacionamentos para evitar múltiplas queries (N+1 problem)
        $orcamento->load('fornecedor', 'itens.produto');
        return view('orcamentos.show', compact('orcamento'));
    }

    public function edit(Orcamento $orcamento)
    {
        $fornecedores = Fornecedor::all();
        $produtos = Produto::all();
        $orcamento->load('itens.produto');
        return view('orcamentos.edit', compact('orcamento', 'fornecedores', 'produtos'));
    }

    public function update(Request $request, Orcamento $orcamento)
    {
        $request->validate([
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'data_orcamento' => 'required|date',
            'status' => 'required|in:pendente,aprovado,rejeitado',
        ]);

        $orcamento->update($request->only(['fornecedor_id', 'data_orcamento', 'status']));

        return redirect()->route('orcamentos.show', $orcamento->id)->with('success', 'Orçamento atualizado com sucesso.');
    }

    public function destroy(Orcamento $orcamento)
    {
        try {
            $orcamento->itens()->delete();
            $orcamento->delete();
            return redirect()->route('orcamentos.index')->with('success', 'Orçamento excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('orcamentos.index')->with('error', 'Erro ao excluir orçamento: ' . $e->getMessage());
        }
    }
}