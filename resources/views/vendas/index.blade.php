@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Vendas</h3>
                    <div class="card-tools">
                        <a href="{{ route('vendas.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nova Venda
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('info'))
                        <div class="alert alert-info">
                            {{ session('info') }}
                        </div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Preço Unit.</th>
                                <th>Subtotal</th>
                                <th>Data da Venda</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vendas as $venda)
                                <tr>
                                    <td>{{ $venda->id }}</td>
                                    <td>{{ $venda->cliente->nome }}</td>
                                    <td>{{ $venda->produto->nome }}</td>
                                    <td>{{ $venda->quantidade }}</td>
                                    <td>R$ {{ number_format($venda->preco_unitario, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($venda->subtotal, 2, ',', '.') }}</td>
                                    <td>{{ $venda->data_venda->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $venda->status == 'pendente' ? 'warning' : ($venda->status == 'pago' ? 'success' : 'danger') }}">
                                            {{ ucfirst($venda->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('vendas.show', $venda) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($venda->status == 'pendente')
                                            <form action="{{ route('vendas.gerar-pagamento', $venda) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fas fa-credit-card"></i> Gerar Pagamento
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('vendas.destroy', $venda) }}" method="POST" style="display: inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta venda?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Nenhuma venda encontrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 