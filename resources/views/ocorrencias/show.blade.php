@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detalhes da Ocorrência</h3>
                    <div>
                        <a href="{{ route('ocorrencias.edit', $ocorrencia) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('ocorrencias.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações da Ocorrência</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID:</strong></td>
                                    <td>{{ $ocorrencia->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Funcionário:</strong></td>
                                    <td>{{ $ocorrencia->funcionario ? $ocorrencia->funcionario->nome : 'Funcionário excluído' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tipo:</strong></td>
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
                                </tr>
                                <tr>
                                    <td><strong>Data:</strong></td>
                                    <td>{{ $ocorrencia->data ? $ocorrencia->data->format('d/m/Y') : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
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
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Detalhes do Horário</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Hora Início:</strong></td>
                                    <td>{{ $ocorrencia->hora_inicio ? $ocorrencia->hora_inicio->format('H:i') : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Hora Fim:</strong></td>
                                    <td>{{ $ocorrencia->hora_fim ? $ocorrencia->hora_fim->format('H:i') : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Quantidade de Horas:</strong></td>
                                    <td>
                                        @if($ocorrencia->quantidade_horas)
                                            {{ number_format($ocorrencia->quantidade_horas, 2) }} horas
                                        @else
                                            Não informado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Valor Calculado:</strong></td>
                                    <td>
                                        @if($ocorrencia->valor_calculado)
                                            R$ {{ number_format($ocorrencia->valor_calculado, 2, ',', '.') }}
                                        @else
                                            Não calculado
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Data de Criação:</strong></td>
                                    <td>{{ $ocorrencia->created_at ? $ocorrencia->created_at->format('d/m/Y H:i') : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Última Atualização:</strong></td>
                                    <td>{{ $ocorrencia->updated_at ? $ocorrencia->updated_at->format('d/m/Y H:i') : 'Não informado' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($ocorrencia->descricao)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>Descrição</h5>
                            <div class="alert alert-info">
                                {{ $ocorrencia->descricao }}
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    @if($ocorrencia->folhaPagamento)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>Folha de Pagamento Vinculada</h5>
                            <div class="alert alert-success">
                                <strong>Mês/Ano:</strong> {{ $ocorrencia->folhaPagamento->mes_referencia }}<br>
                                <strong>Status:</strong> 
                                                        @if($ocorrencia->folhaPagamento->status == 'gerada')
                            <span class="badge bg-info text-dark">{{ $ocorrencia->folhaPagamento::STATUS[$ocorrencia->folhaPagamento->status] }}</span>
                        @elseif($ocorrencia->folhaPagamento->status == 'paga')
                            <span class="badge bg-success">{{ $ocorrencia->folhaPagamento::STATUS[$ocorrencia->folhaPagamento->status] }}</span>
                        @else
                            <span class="badge bg-danger">{{ $ocorrencia->folhaPagamento::STATUS[$ocorrencia->folhaPagamento->status] }}</span>
                        @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 