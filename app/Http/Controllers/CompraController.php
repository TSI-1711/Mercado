<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Fornecedor;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompraController extends Controller
{
    // Os métodos index, create, show, etc., são muito similares ao OrcamentoController

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
}