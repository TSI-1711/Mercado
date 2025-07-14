<?php

namespace App\Http\Controllers;

use App\Models\Ocorrencias;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OcorrenciasController extends Controller
{

    public function index()
    {
        $ocorrencias = Ocorrencias::with('funcionario')
            ->whereHas('funcionario')
            ->orderBy('data', 'desc')
            ->paginate(15);
        return view('ocorrencias.index', compact('ocorrencias'));
    }


    public function create()
    {
        $funcionarios = Funcionario::where('ativo', true)->orderBy('nome')->get();
        return view('ocorrencias.create', compact('funcionarios'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'funcionario_id' => 'required|exists:funcionarios,id',
            'tipo' => 'required|in:hora_extra,falta,atraso,outro',
            'data' => 'required|date',
            'hora_inicio' => 'nullable|date_format:H:i',
            'hora_fim' => 'nullable|date_format:H:i|after:hora_inicio',
            'quantidade_horas' => 'nullable|numeric|min:0|max:24',
            'descricao' => 'nullable|string|max:500',
            'status' => 'required|in:pendente,aprovada,rejeitada,processada'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $ocorrencia = Ocorrencias::create($request->all());
        
        if ($ocorrencia->tipo == 'hora_extra' && $ocorrencia->quantidade_horas) {
            $funcionario = $ocorrencia->funcionario;
            $ocorrencia->valor_calculado = $ocorrencia->quantidade_horas * $funcionario->valor_hora_extra;
            $ocorrencia->save();
        }

        return redirect()->route('ocorrencias.index')
            ->with('success', 'Ocorrência cadastrada com sucesso!');
    }


    public function show(Ocorrencias $ocorrencia)
    {
        if (!$ocorrencia->funcionario) {
            return redirect()->route('ocorrencias.index')
                ->with('error', 'Ocorrência não encontrada ou funcionário foi excluído.');
        }
        
        return view('ocorrencias.show', compact('ocorrencia'));
    }


    public function edit(Ocorrencias $ocorrencia)
    {
        if (!$ocorrencia->funcionario) {
            return redirect()->route('ocorrencias.index')
                ->with('error', 'Ocorrência não encontrada ou funcionário foi excluído.');
        }
        
        $funcionarios = Funcionario::where('ativo', true)->orderBy('nome')->get();
        return view('ocorrencias.edit', compact('ocorrencia', 'funcionarios'));
    }


    public function update(Request $request, Ocorrencias $ocorrencia)
    {
        if (!$ocorrencia->funcionario) {
            return redirect()->route('ocorrencias.index')
                ->with('error', 'Ocorrência não encontrada ou funcionário foi excluído.');
        }
        
        $validator = Validator::make($request->all(), [
            'funcionario_id' => 'required|exists:funcionarios,id',
            'tipo' => 'required|in:hora_extra,falta,atraso,outro',
            'data' => 'required|date',
            'hora_inicio' => 'nullable|date_format:H:i',
            'hora_fim' => 'nullable|date_format:H:i|after:hora_inicio',
            'quantidade_horas' => 'nullable|numeric|min:0|max:24',
            'descricao' => 'nullable|string|max:500',
            'status' => 'required|in:pendente,aprovada,rejeitada,processada'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $ocorrencia->update($request->all());
        
        if ($ocorrencia->tipo == 'hora_extra' && $ocorrencia->quantidade_horas) {
            $funcionario = $ocorrencia->funcionario;
            $ocorrencia->valor_calculado = $ocorrencia->quantidade_horas * $funcionario->valor_hora_extra;
            $ocorrencia->save();
        }

        return redirect()->route('ocorrencias.index')
            ->with('success', 'Ocorrência atualizada com sucesso!');
    }


    public function destroy(Ocorrencias $ocorrencia)
    {
        if (!$ocorrencia->funcionario) {
            return redirect()->route('ocorrencias.index')
                ->with('error', 'Ocorrência não encontrada ou funcionário foi excluído.');
        }
        
        try {
            $ocorrencia->delete();
            return redirect()->route('ocorrencias.index')
                ->with('success', 'Ocorrência excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('ocorrencias.index')
                ->with('error', 'Não foi possível excluir a ocorrência. Verifique se não há registros relacionados.');
        }
    }
}
