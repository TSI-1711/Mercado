@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalhes da Venda #{{ $venda->id }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('vendas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                        @if($venda->status == 'pendente')
                            <form action="{{ route('vendas.gerar-pagamento', $venda) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-credit-card"></i> Gerar Pagamento
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informações da Venda</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID:</strong></td>
                                    <td>{{ $venda->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Data da Venda:</strong></td>
                                    <td>{{ $venda->data_venda->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge badge-{{ $venda->status == 'pendente' ? 'warning' : ($venda->status == 'pago' ? 'success' : 'danger') }}">
                                            {{ ucfirst($venda->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Valor Total:</strong></td>
                                    <td><strong>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</strong></td>
                                </tr>
                                @if($venda->observacoes)
                                    <tr>
                                        <td><strong>Observações:</strong></td>
                                        <td>{{ $venda->observacoes }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Informações do Cliente</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nome:</strong></td>
                                    <td>{{ $venda->cliente->nome }}</td>
                                </tr>
                                <tr>
                                    <td><strong>CPF/CNPJ:</strong></td>
                                    <td>{{ $venda->cliente->cpf_cnpj }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email:</strong></td>
                                    <td>{{ $venda->cliente->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Telefone:</strong></td>
                                    <td>{{ $venda->cliente->telefone }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Endereço:</strong></td>
                                    <td>{{ $venda->cliente->endereco }}, {{ $venda->cliente->cidade }}/{{ $venda->cliente->estado }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <h5>Produto da Venda</h5>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Quantidade</th>
                                <th>Preço Unitário</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $venda->produto->nome }}</td>
                                <td>{{ $venda->quantidade }}</td>
                                <td>R$ {{ number_format($venda->preco_unitario, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format($venda->subtotal, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                <td><strong>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 