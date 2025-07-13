<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with(['cliente', 'produto'])->orderBy('created_at', 'desc')->get();
        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        $clientes = Cliente::where('ativo', true)->get();
        $produtos = Produto::where('estoque', '>', 0)->get();
        return view('vendas.create', compact('clientes', 'produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'preco_unitario' => 'required|numeric|min:0',
            'data_venda' => 'required|date',
            'observacoes' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            $subtotal = $request->quantidade * $request->preco_unitario;
            $valorTotal = $subtotal;

            $venda = Venda::create([
                'cliente_id' => $request->cliente_id,
                'produto_id' => $request->produto_id,
                'quantidade' => $request->quantidade,
                'preco_unitario' => $request->preco_unitario,
                'subtotal' => $subtotal,
                'data_venda' => $request->data_venda,
                'valor_total' => $valorTotal,
                'status' => 'pendente',
                'observacoes' => $request->observacoes
            ]);

            $produto = Produto::find($request->produto_id);
            $produto->decrement('estoque', $request->quantidade);

            DB::commit();

            return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro ao criar venda: ' . $e->getMessage());
        }
    }

    public function show(Venda $venda)
    {
        $venda->load(['cliente', 'produto']);
        return view('vendas.show', compact('venda'));
    }



    public function destroy(Venda $venda)
    {
        try {
            DB::beginTransaction();

            $produto = Produto::find($venda->produto_id);
            $produto->increment('estoque', $venda->quantidade);

            $venda->delete();

            DB::commit();

            return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro ao excluir venda: ' . $e->getMessage());
        }
    }

    public function gerarPagamento(Venda $venda)
    {
        return back()->with('info', 'Funcionalidade de pagamento será implementada em breve!');
    }
} 