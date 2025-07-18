@extends('template')

@section('conteudo')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Orçamento #{{ $orcamento->id }}</h4>
                        <div>
                            <a href="{{ route('orcamentos.edit', $orcamento->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <a href="{{ route('orcamentos.index') }}" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações do Orçamento</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">ID:</th>
                                    <td>{{ $orcamento->id }}</td>
                                </tr>
                                <tr>
                                    <th>Fornecedor:</th>
                                    <td>{{ $orcamento->fornecedor->nome }}</td>
                                </tr>
                                <tr>
                                    <th>Data:</th>
                                    <td>{{ \Carbon\Carbon::parse($orcamento->data_orcamento)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge {{ $orcamento->status === 'aprovado' ? 'bg-success' : ($orcamento->status === 'rejeitado' ? 'bg-danger' : 'bg-warning') }} fs-6">
                                            {{ ucfirst($orcamento->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Valor Total:</th>
                                    <td><strong>R$ {{ number_format($orcamento->valor_total, 2, ',', '.') }}</strong></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Contato do Fornecedor</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Telefone:</th>
                                    <td>{{ $orcamento->fornecedor->telefone ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $orcamento->fornecedor->email ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <th>Endereço:</th>
                                    <td>{{ $orcamento->fornecedor->endereco ?? 'Não informado' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <h5>Itens do Orçamento</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unitário</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orcamento->itens as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->produto->nome }}</td>
                                        <td>{{ $item->quantidade }}</td>
                                        <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>
                                        <td>R$ {{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="4" class="text-end">Total:</th>
                                    <th>R$ {{ number_format($orcamento->valor_total, 2, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if($orcamento->status === 'pendente')
                        <div class="mt-4">
                            <h6>Ações</h6>
                            <div class="btn-group" role="group">
                                <form action="{{ route('orcamentos.update', $orcamento->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="aprovado">
                                    <button type="submit" class="btn btn-success me-2" onclick="return confirm('Aprovar este orçamento?')">
                                        <i class="bi bi-check-circle"></i> Aprovar
                                    </button>
                                </form>
                                
                                <form action="{{ route('orcamentos.update', $orcamento->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejeitado">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Rejeitar este orçamento?')">
                                        <i class="bi bi-x-circle"></i> Rejeitar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 