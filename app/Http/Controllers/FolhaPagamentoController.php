<?php

namespace App\Http\Controllers;

use App\Models\FolhaPagamento;
use App\Models\Funcionario;
use App\Models\Ocorrencias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class FolhaPagamentoController extends Controller
{

    public function index()
    {
        $folhasPagamento = FolhaPagamento::with('funcionario')
            ->whereHas('funcionario')
            ->orderBy('mes_referencia', 'desc')
            ->paginate(15);
        return view('folhaPagamento.index', compact('folhasPagamento'));
    }


    public function create()
    {
        $funcionarios = Funcionario::where('ativo', true)->orderBy('nome')->get();
        return view('folhaPagamento.create', compact('funcionarios'));
    }


    public function store(Request $request)
    {
        return redirect()->route('folhaPagamento.create')
            ->with('info', 'Use as opções de geração automática ou global disponíveis na página.');
    }


    public function show(FolhaPagamento $folhaPagamento)
    {
        if (!$folhaPagamento->funcionario) {
            return redirect()->route('folhaPagamento.index')
                ->with('error', 'Folha de pagamento não encontrada ou funcionário foi excluído.');
        }
        
        $ocorrencias = $folhaPagamento->ocorrencias()->with('funcionario')->get();
        return view('folhaPagamento.show', compact('folhaPagamento', 'ocorrencias'));
    }


    public function edit(FolhaPagamento $folhaPagamento)
    {
        if (!$folhaPagamento->funcionario) {
            return redirect()->route('folhaPagamento.index')
                ->with('error', 'Folha de pagamento não encontrada ou funcionário foi excluído.');
        }
        
        $funcionarios = Funcionario::where('ativo', true)->orderBy('nome')->get();
        return view('folhaPagamento.edit', compact('folhaPagamento', 'funcionarios'));
    }


    public function update(Request $request, FolhaPagamento $folhaPagamento)
    {
        if (!$folhaPagamento->funcionario) {
            return redirect()->route('folhaPagamento.index')
                ->with('error', 'Folha de pagamento não encontrada ou funcionário foi excluído.');
        }
        
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:gerada,paga,cancelada',
            'observacoes' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $folhaPagamento->update($request->only(['status', 'observacoes']));

        return redirect()->route('folhaPagamento.index')
            ->with('success', 'Folha de pagamento atualizada com sucesso!');
    }


    public function destroy(FolhaPagamento $folhaPagamento)
    {
        if (!$folhaPagamento->funcionario) {
            return redirect()->route('folhaPagamento.index')
                ->with('error', 'Folha de pagamento não encontrada ou funcionário foi excluído.');
        }
        
        try {
            $folhaPagamento->delete();
            return redirect()->route('folhaPagamento.index')
                ->with('success', 'Folha de pagamento excluída com sucesso!');
        } catch (\Exception $e) {
            return redirect()->route('folhaPagamento.index')
                ->with('error', 'Não foi possível excluir a folha de pagamento. Verifique se não há registros relacionados.');
        }
    }


    public function gerarFolha(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'funcionario_id' => 'required|exists:funcionarios,id',
            'mes_referencia' => 'required|string|max:7'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $funcionario = Funcionario::find($request->funcionario_id);
        $mesReferencia = $request->mes_referencia;

        $folhaExistente = FolhaPagamento::where('funcionario_id', $funcionario->id)
            ->where('mes_referencia', $mesReferencia)
            ->first();

        if ($folhaExistente) {
            return redirect()->back()
                ->with('error', 'Já existe uma folha de pagamento para este funcionário neste mês.');
        }

        $dataInicio = Carbon::parse($mesReferencia . '-01');
        $dataFim = $dataInicio->copy()->endOfMonth();

        $ocorrencias = Ocorrencias::where('funcionario_id', $funcionario->id)
            ->whereBetween('data', [$dataInicio, $dataFim])
            ->where('status', 'aprovada')
            ->get();

        $totalHorasExtras = $ocorrencias->where('tipo', 'hora_extra')->sum('quantidade_horas');
        $totalFaltas = $ocorrencias->where('tipo', 'falta')->count();
        $valorHorasExtras = $ocorrencias->where('tipo', 'hora_extra')->sum('valor_calculado');
        
        $valorDia = $funcionario->salario_base / 30;
        $descontoFaltas = $totalFaltas * $valorDia;

        $salarioBruto = $funcionario->salario_base + $valorHorasExtras - $descontoFaltas;
        
        $inss = $this->calcularINSS($salarioBruto);
        $irrf = $this->calcularIRRF($salarioBruto, $inss);
        $fgts = $salarioBruto * 0.08;
        $salarioLiquido = $salarioBruto - $inss - $irrf;

        $folhaPagamento = FolhaPagamento::create([
            'funcionario_id' => $funcionario->id,
            'mes_referencia' => $mesReferencia,
            'salario_base' => $funcionario->salario_base,
            'total_proventos' => $valorHorasExtras,
            'total_descontos' => $descontoFaltas,
            'salario_bruto' => $salarioBruto,
            'inss' => $inss,
            'irrf' => $irrf,
            'fgts' => $fgts,
            'salario_liquido' => $salarioLiquido,
            'data_geracao' => now(),
            'status' => 'gerada'
        ]);

        foreach ($ocorrencias as $ocorrencia) {
            $ocorrencia->update(['folha_pagamento_id' => $folhaPagamento->id]);
        }

        return redirect()->route('folhaPagamento.show', $folhaPagamento)
            ->with('success', 'Folha de pagamento gerada automaticamente com sucesso!');
    }


    private function calcularINSS($salarioBruto)
    {
        $faixas = [
            [0.00, 1518.00, 0.075],
            [1518.01, 2666.68, 0.09],
            [2666.69, 4000.03, 0.12],
            [4000.04, 7786.02, 0.14]
        ];
    
        $limiteMaximo = 7786.02;
        $inss = 0.0;
        $base = $salarioBruto > $limiteMaximo ? $limiteMaximo : $salarioBruto;
    
        foreach ($faixas as $i => $faixa) {
            $faixaInferior = $faixa[0];
            $faixaSuperior = $faixa[1];
            $aliquota = $faixa[2];
    
            if ($base > $faixaSuperior) {
                $inss += ($faixaSuperior - $faixaInferior) * $aliquota;
            } else {
                $inss += ($base - $faixaInferior) * $aliquota;
                break;
            }
        }
    
        return $inss;
    }
    
    private function calcularIRRF($salarioBruto, $inss)
    {
        $baseCalculo = $salarioBruto - $inss;
    
        if ($baseCalculo <= 2112.00) {
            return 0;
        } elseif ($baseCalculo <= 2826.65) {
            return ($baseCalculo * 0.075) - 158.40;
        } elseif ($baseCalculo <= 3751.05) {
            return ($baseCalculo * 0.15) - 370.40;
        } elseif ($baseCalculo <= 4664.68) {
            return ($baseCalculo * 0.225) - 651.73;
        } else {
            return ($baseCalculo * 0.275) - 884.96;
        }
    }
    


    private function calcularImpostos(FolhaPagamento $folhaPagamento)
    {
        $inss = $this->calcularINSS($folhaPagamento->salario_bruto);
        $irrf = $this->calcularIRRF($folhaPagamento->salario_bruto, $inss);
        $fgts = $folhaPagamento->salario_bruto * 0.08;

        $folhaPagamento->update([
            'inss' => $inss,
            'irrf' => $irrf,
            'fgts' => $fgts,
            'salario_liquido' => $folhaPagamento->salario_bruto - $inss - $irrf
        ]);
    }


    private function calcularFolhaPagamento(FolhaPagamento $folhaPagamento)
    {
        $this->calcularImpostos($folhaPagamento);
    }
}
