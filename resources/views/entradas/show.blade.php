@extends('template')

@section('conteudo')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Entrada #{{ $entrada->id }}</h4>
                        <div>
                            <a href="{{ route('entradas.edit', $entrada->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <a href="{{ route('entradas.index') }}" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações da Entrada</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">ID:</th>
                                    <td>{{ $entrada->id }}</td>
                                </tr>
                                <tr>
                                    <th>Compra:</th>
                                    <td>#{{ $entrada->compra->id }}</td>
                                </tr>
                                <tr>
                                    <th>Fornecedor:</th>
                                    <td>{{ $entrada->compra->fornecedor->nome }}</td>
                                </tr>
                                <tr>
                                    <th>Data da Entrada:</th>
                                    <td>{{ \Carbon\Carbon::parse($entrada->data_entrada)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status da Compra:</th>
                                    <td>
                                        <span class="badge {{ $entrada->compra->status === 'recebido' ? 'bg-success' : 'bg-warning' }} fs-6">
                                            {{ ucfirst($entrada->compra->status) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Observações</h5>
                            <p class="text-muted">
                                {{ $entrada->observacoes ?: 'Nenhuma observação registrada.' }}
                            </p>
                            
                            <h5>Informações do Sistema</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Criado em:</th>
                                    <td>{{ $entrada->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Última atualização:</th>
                                    <td>{{ $entrada->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <h5>Itens Recebidos</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Produto</th>
                                    <th>Quantidade Pedida</th>
                                    <th>Quantidade Recebida</th>
                                    <th>Preço Unitário</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entrada->itens as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->produto->nome }}</td>
                                        <td>{{ $item->quantidade_pedida ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-success">{{ $item->quantidade_recebida }}</span>
                                        </td>
                                        <td>R$ {{ number_format($item->preco_unitario ?? 0, 2, ',', '.') }}</td>
                                        <td>R$ {{ number_format(($item->quantidade_recebida * ($item->preco_unitario ?? 0)), 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Importante:</strong> Esta entrada foi registrada e o estoque dos produtos foi atualizado automaticamente.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 