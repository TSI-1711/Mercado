<?php

namespace App\Http\Controllers;

use App\Models\TipoDespesa;
use Illuminate\Http\Request;

class TipoDespesaController extends Controller
{
    public function index()
    {
        $tipos = TipoDespesa::all();
        return view('tipo_despesa.index', compact('tipos'));
    }

    public function create()
    {
        return view('tipo_despesa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
        ]);

        TipoDespesa::create($request->all());
        return redirect()->route('tipo_despesa.index')->with('success', 'Tipo de despesa cadastrado com sucesso.');
    }

    public function edit(TipoDespesa $tipo_despesa)
    {
        return view('tipo_despesa.edit', compact('tipo_despesa'));
    }

    public function update(Request $request, TipoDespesa $tipo_despesa)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
        ]);

        $tipo_despesa->update($request->all());
        return redirect()->route('tipo_despesa.index')->with('success', 'Tipo de despesa atualizado com sucesso.');
    }

    public function destroy(TipoDespesa $tipo_despesa)
    {
        $tipo_despesa->delete();
        return redirect()->route('tipo_despesa.index')->with('success', 'Tipo de despesa excluído.');
    }
}
