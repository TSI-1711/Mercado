@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Folha de Pagamento - {{ $folhaPagamento->funcionario ? $folhaPagamento->funcionario->nome : 'Funcionário excluído' }}</h3>
                    <div>
                        <a href="{{ route('folhaPagamento.edit', $folhaPagamento) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('folhaPagamento.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações do Funcionário</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nome:</strong></td>
                                    <td>{{ $folhaPagamento->funcionario ? $folhaPagamento->funcionario->nome : 'Funcionário excluído' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Cargo:</strong></td>
                                    <td>{{ $folhaPagamento->funcionario ? $folhaPagamento->funcionario->cargo : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mês/Ano:</strong></td>
                                    <td>{{ $folhaPagamento->mes_referencia }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                                                @if($folhaPagamento->status == 'gerada')
                            <span class="badge bg-info text-dark">{{ $folhaPagamento::STATUS[$folhaPagamento->status] }}</span>
                        @elseif($folhaPagamento->status == 'paga')
                            <span class="badge bg-success">{{ $folhaPagamento::STATUS[$folhaPagamento->status] }}</span>
                        @else
                            <span class="badge bg-danger">{{ $folhaPagamento::STATUS[$folhaPagamento->status] }}</span>
                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Valores da Folha</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Salário Base:</strong></td>
                                    <td>R$ {{ number_format($folhaPagamento->salario_base, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Proventos:</strong></td>
                                    <td>R$ {{ number_format($folhaPagamento->total_proventos, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Descontos:</strong></td>
                                    <td>R$ {{ number_format($folhaPagamento->total_descontos, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Salário Bruto:</strong></td>
                                    <td><strong>R$ {{ number_format($folhaPagamento->salario_bruto, 2, ',', '.') }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>Descontos e Impostos</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">INSS</h6>
                                            <h4 class="text-primary">R$ {{ number_format($folhaPagamento->inss, 2, ',', '.') }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">IRRF</h6>
                                            <h4 class="text-warning">R$ {{ number_format($folhaPagamento->irrf, 2, ',', '.') }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">FGTS</h6>
                                            <h4 class="text-info">R$ {{ number_format($folhaPagamento->fgts, 2, ',', '.') }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">Salário Líquido</h6>
                                            <h4>R$ {{ number_format($folhaPagamento->salario_liquido, 2, ',', '.') }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if($folhaPagamento->observacoes)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>Observações</h5>
                            <div class="alert alert-info">
                                {{ $folhaPagamento->observacoes }}
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($ocorrencias->count() > 0)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>Ocorrências Vinculadas</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Tipo</th>
                                            <th>Horas</th>
                                            <th>Valor</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ocorrencias as $ocorrencia)
                                            <tr>
                                                <td>{{ $ocorrencia->data ? $ocorrencia->data->format('d/m/Y') : '' }}</td>
                                                <td>
                                                    @if($ocorrencia->tipo == 'hora_extra')
                                                        <span class="badge bg-success">{{ $ocorrencia::TIPOS[$ocorrencia->tipo] }}</span>
                                                    @elseif($ocorrencia->tipo == 'falta')
                                                        <span class="badge bg-danger">{{ $ocorrencia::TIPOS[$ocorrencia->tipo] }}</span>
                                                    @elseif($ocorrencia->tipo == 'atraso')
                                                        <span class="badge bg-warning text-dark">{{ $ocorrencia::TIPOS[$ocorrencia->tipo] }}</span>
                                                    @else
                                                        <span class="badge bg-info text-dark">{{ $ocorrencia::TIPOS[$ocorrencia->tipo] }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($ocorrencia->quantidade_horas)
                                                        {{ number_format($ocorrencia->quantidade_horas, 2) }}h
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($ocorrencia->valor_calculado)
                                                        R$ {{ number_format($ocorrencia->valor_calculado, 2, ',', '.') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                                            @if($ocorrencia->status == 'pendente')
                            <span class="badge bg-warning text-dark">{{ $ocorrencia::STATUS[$ocorrencia->status] }}</span>
                        @elseif($ocorrencia->status == 'aprovada')
                            <span class="badge bg-success">{{ $ocorrencia::STATUS[$ocorrencia->status] }}</span>
                        @elseif($ocorrencia->status == 'rejeitada')
                            <span class="badge bg-danger">{{ $ocorrencia::STATUS[$ocorrencia->status] }}</span>
                        @else
                            <span class="badge bg-info text-dark">{{ $ocorrencia::STATUS[$ocorrencia->status] }}</span>
                        @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>Informações Adicionais</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Data de Geração:</strong></td>
                                    <td>{{ $folhaPagamento->data_geracao ? $folhaPagamento->data_geracao->format('d/m/Y H:i') : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Data de Pagamento:</strong></td>
                                    <td>{{ $folhaPagamento->data_pagamento ? $folhaPagamento->data_pagamento->format('d/m/Y') : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Data de Criação:</strong></td>
                                    <td>{{ $folhaPagamento->created_at ? $folhaPagamento->created_at->format('d/m/Y H:i') : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última Atualização:</strong></td>
                                    <td>{{ $folhaPagamento->updated_at ? $folhaPagamento->updated_at->format('d/m/Y H:i') : 'Não informado' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 