<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ocorrencias;
use App\Models\Funcionario;
use Carbon\Carbon;

class OcorrenciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $funcionarios = Funcionario::all();
        
        if ($funcionarios->count() == 0) {
            return;
        }

        $ocorrencias = [
            [
                'funcionario_id' => $funcionarios->first()->id,
                'tipo' => 'hora_extra',
                'data' => Carbon::now()->subDays(5),
                'hora_inicio' => '18:00',
                'hora_fim' => '22:00',
                'quantidade_horas' => 4.00,
                'descricao' => 'Hora extra para finalizar projeto urgente',
                'status' => 'aprovada'
            ],
            [
                'funcionario_id' => $funcionarios->first()->id,
                'tipo' => 'falta',
                'data' => Carbon::now()->subDays(10),
                'descricao' => 'Falta justificada - consulta médica',
                'status' => 'aprovada'
            ],
            [
                'funcionario_id' => $funcionarios->first()->id,
                'tipo' => 'hora_extra',
                'data' => Carbon::now()->subDays(15),
                'hora_inicio' => '19:00',
                'hora_fim' => '21:30',
                'quantidade_horas' => 2.50,
                'descricao' => 'Hora extra para reunião com cliente',
                'status' => 'aprovada'
            ],
            [
                'funcionario_id' => $funcionarios->skip(1)->first()->id,
                'tipo' => 'atraso',
                'data' => Carbon::now()->subDays(3),
                'hora_inicio' => '08:30',
                'hora_fim' => '09:00',
                'quantidade_horas' => 0.50,
                'descricao' => 'Atraso devido a problemas de transporte',
                'status' => 'aprovada'
            ],
            [
                'funcionario_id' => $funcionarios->skip(1)->first()->id,
                'tipo' => 'hora_extra',
                'data' => Carbon::now()->subDays(8),
                'hora_inicio' => '17:00',
                'hora_fim' => '20:00',
                'quantidade_horas' => 3.00,
                'descricao' => 'Hora extra para inventário',
                'status' => 'aprovada'
            ],
            [
                'funcionario_id' => $funcionarios->skip(2)->first()->id,
                'tipo' => 'falta',
                'data' => Carbon::now()->subDays(12),
                'descricao' => 'Falta - problema familiar',
                'status' => 'pendente'
            ],
            [
                'funcionario_id' => $funcionarios->skip(2)->first()->id,
                'tipo' => 'hora_extra',
                'data' => Carbon::now()->subDays(20),
                'hora_inicio' => '18:00',
                'hora_fim' => '21:00',
                'quantidade_horas' => 3.00,
                'descricao' => 'Hora extra para organização do estoque',
                'status' => 'aprovada'
            ],
            [
                'funcionario_id' => $funcionarios->skip(3)->first()->id,
                'tipo' => 'outro',
                'data' => Carbon::now()->subDays(7),
                'descricao' => 'Participação em treinamento externo',
                'status' => 'aprovada'
            ],
            [
                'funcionario_id' => $funcionarios->skip(3)->first()->id,
                'tipo' => 'hora_extra',
                'data' => Carbon::now()->subDays(25),
                'hora_inicio' => '16:00',
                'hora_fim' => '19:00',
                'quantidade_horas' => 3.00,
                'descricao' => 'Hora extra para preparação de relatório',
                'status' => 'aprovada'
            ],
            [
                'funcionario_id' => $funcionarios->skip(4)->first()->id,
                'tipo' => 'falta',
                'data' => Carbon::now()->subDays(18),
                'descricao' => 'Falta - motivo pessoal',
                'status' => 'rejeitada'
            ]
        ];

        foreach ($funcionarios as $funcionario) {
            $horaExtra = [
                'funcionario_id' => $funcionario->id,
                'folha_pagamento_id' => null,
                'tipo' => 'hora_extra',
                'data' => Carbon::now()->subDays(rand(1, 30)),
                'hora_inicio' => '18:00',
                'hora_fim' => '20:00',
                'quantidade_horas' => 2.00,
                'descricao' => 'Hora extra automática para testes',
                'status' => 'aprovada',
                'valor_calculado' => 2.00 * $funcionario->valor_hora_extra
            ];
            $ocorrencias[] = $horaExtra;
        }

        foreach ($ocorrencias as $ocorrencia) {
            $ocorrencia = array_merge([
                'funcionario_id' => null,
                'folha_pagamento_id' => null,
                'tipo' => null,
                'data' => null,
                'hora_inicio' => null,
                'hora_fim' => null,
                'quantidade_horas' => null,
                'descricao' => null,
                'status' => null,
                'valor_calculado' => null
            ], $ocorrencia);

            if ($ocorrencia['tipo'] === 'hora_extra' && empty($ocorrencia['valor_calculado'])) {
                $funcionario = $funcionarios->find($ocorrencia['funcionario_id']);
                if ($funcionario && !empty($ocorrencia['quantidade_horas'])) {
                    $ocorrencia['valor_calculado'] = $ocorrencia['quantidade_horas'] * $funcionario->valor_hora_extra;
                }
            }

            Ocorrencias::create($ocorrencia);
        }
    }
} 