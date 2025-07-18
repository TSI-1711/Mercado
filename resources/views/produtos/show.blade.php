@extends('template')

@section('conteudo')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Detalhes do Produto</h4>
                        <div>
                            <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <a href="{{ route('produtos.index') }}" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações Básicas</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="30%">ID:</th>
                                    <td>{{ $produto->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nome:</th>
                                    <td>{{ $produto->nome }}</td>
                                </tr>
                                <tr>
                                    <th>Preço de Custo:</th>
                                    <td>R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Estoque Atual:</th>
                                    <td>
                                        <span class="badge {{ $produto->estoque > 10 ? 'bg-success' : ($produto->estoque > 0 ? 'bg-warning' : 'bg-danger') }} fs-6">
                                            {{ $produto->estoque }} unidades
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Descrição</h5>
                            <p class="text-muted">
                                {{ $produto->descricao ?: 'Nenhuma descrição fornecida.' }}
                            </p>
                            
                            <h5>Informações do Sistema</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Criado em:</th>
                                    <td>{{ $produto->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Última atualização:</th>
                                    <td>{{ $produto->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($produto->fornecedores->count() > 0)
                        <hr>
                        <h5>Fornecedores Relacionados</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Fornecedor</th>
                                        <th>Contato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($produto->fornecedores as $fornecedor)
                                        <tr>
                                            <td>{{ $fornecedor->nome }}</td>
                                            <td>{{ $fornecedor->telefone }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 