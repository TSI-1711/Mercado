@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Detalhes do Funcionário</h3>
                    <div>
                        <a href="{{ route('funcionarios.edit', $funcionario) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações Pessoais</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nome:</strong></td>
                                    <td>{{ $funcionario->nome }}</td>
                                </tr>
                                <tr>
                                    <td><strong>CPF:</strong></td>
                                    <td>{{ $funcionario->cpf }}</td>
                                </tr>
                                <tr>
                                    <td><strong>RG:</strong></td>
                                    <td>{{ $funcionario->rg ?: 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Data de Nascimento:</strong></td>
                                    <td>{{ $funcionario->data_nascimento ? $funcionario->data_nascimento->format('d/m/Y') : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Telefone:</strong></td>
                                    <td>{{ $funcionario->telefone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $funcionario->email }}</td>
                                </tr>

                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Informações Profissionais</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Cargo:</strong></td>
                                    <td>{{ $funcionario->cargo }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Data de Admissão:</strong></td>
                                    <td>{{ $funcionario->data_admissao ? $funcionario->data_admissao->format('d/m/Y') : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Salário Base:</strong></td>
                                    <td>R$ {{ number_format($funcionario->salario_base, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Valor Hora Extra:</strong></td>
                                    <td>{{ $funcionario->valor_hora_extra ? 'R$ ' . number_format($funcionario->valor_hora_extra, 2, ',', '.') : 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($funcionario->ativo)
                                            <span class="badge bg-success">Ativo</span>
                                        @else
                                            <span class="badge bg-danger">Inativo</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>Informações Bancárias</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Banco:</strong></td>
                                    <td>{{ $funcionario->banco ?: 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Agência:</strong></td>
                                    <td>{{ $funcionario->agencia ?: 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Conta:</strong></td>
                                    <td>{{ $funcionario->conta ?: 'Não informado' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    @if($funcionario->folhasPagamento->count() > 0)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h5>Folhas de Pagamento (Últimas 5)</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Mês/Ano</th>
                                            <th>Salário Bruto</th>
                                            <th>Salário Líquido</th>
                                            <th>Status</th>
                                            <th>Data de Geração</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($funcionario->folhasPagamento()->orderBy('mes_referencia', 'desc')->limit(5)->get() as $folha)
                                            <tr>
                                                <td>{{ $folha->mes_referencia }}</td>
                                                <td>R$ {{ number_format($folha->salario_bruto, 2, ',', '.') }}</td>
                                                <td>R$ {{ number_format($folha->salario_liquido, 2, ',', '.') }}</td>
                                                <td>
                                                                            @if($folha->status == 'gerada')
                            <span class="badge bg-info text-dark">{{ $folha::STATUS[$folha->status] }}</span>
                        @elseif($folha->status == 'paga')
                            <span class="badge bg-success">{{ $folha::STATUS[$folha->status] }}</span>
                        @else
                            <span class="badge bg-danger">{{ $folha::STATUS[$folha->status] }}</span>
                        @endif
                                                </td>
                                                <td>{{ $folha->data_geracao ? $folha->data_geracao->format('d/m/Y') : 'Não informado' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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