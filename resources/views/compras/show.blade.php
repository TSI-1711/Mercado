@extends('template')

@section('conteudo')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Ordem de Compra #{{ $compra->id }}</h4>
                        <div>
                            <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <a href="{{ route('compras.index') }}" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações da Ordem de Compra</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">ID:</th>
                                    <td>{{ $compra->id }}</td>
                                </tr>
                                <tr>
                                    <th>Fornecedor:</th>
                                    <td>{{ $compra->fornecedor->nome }}</td>
                                </tr>
                                <tr>
                                    <th>Data:</th>
                                    <td>{{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status:</th>
                                    <td>
                                        <span class="badge {{ $compra->status === 'recebido' ? 'bg-success' : ($compra->status === 'cancelado' ? 'bg-danger' : 'bg-warning') }} fs-6">
                                            {{ ucfirst($compra->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Valor Total:</th>
                                    <td><strong>R$ {{ number_format($compra->valor_total, 2, ',', '.') }}</strong></td>
                                </tr>
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Contato do Fornecedor</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="40%">Telefone:</th>
                                    <td>{{ $compra->fornecedor->telefone ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $compra->fornecedor->email ?? 'Não informado' }}</td>
                                </tr>
                                <tr>
                                    <th>Endereço:</th>
                                    <td>{{ $compra->fornecedor->endereco ?? 'Não informado' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <h5>Itens da Ordem de Compra</h5>
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
                                @foreach($compra->itens as $index => $item)
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
                                    <th>R$ {{ number_format($compra->valor_total, 2, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    @if($compra->status === 'em_aberto')
                        <div class="mt-4">
                            <h6>Ações</h6>
                            <div class="btn-group" role="group">
                                <a href="{{ route('entradas.create', ['compra_id' => $compra->id]) }}" class="btn btn-success me-2">
                                    <i class="bi bi-box-arrow-in-down"></i> Registrar Entrada
                                </a>
                                
                                <form action="{{ route('compras.update', $compra->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="cancelado">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Cancelar esta ordem de compra?')">
                                        <i class="bi bi-x-circle"></i> Cancelar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if($compra->entradas->count() > 0)
                        <hr>
                        <h5>Entradas Relacionadas</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Data</th>
                                        <th>Observações</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($compra->entradas as $entrada)
                                        <tr>
                                            <td>{{ $entrada->id }}</td>
                                            <td>{{ \Carbon\Carbon::parse($entrada->data_entrada)->format('d/m/Y') }}</td>
                                            <td>{{ Str::limit($entrada->observacoes, 30) }}</td>
                                            <td>
                                                <a href="{{ route('entradas.show', $entrada->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
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