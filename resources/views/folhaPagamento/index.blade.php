@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Folhas de Pagamento</h3>
                    <div>
                        <a href="{{ route('folhaPagamento.create') }}" class="btn btn-success">
                            <i class="fas fa-magic"></i> Gerar Automaticamente
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Funcionário</th>
                                    <th>Mês/Ano</th>
                                    <th>Salário Base</th>
                                    <th>Salário Bruto</th>
                                    <th>Salário Líquido</th>
                                    <th>Status</th>
                                    <th>Data Geração</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($folhasPagamento as $folha)
                                    <tr>
                                        <td>{{ $folha->id }}</td>
                                        <td>{{ $folha->funcionario ? $folha->funcionario->nome : 'Funcionário excluído' }}</td>
                                        <td>{{ $folha->mes_referencia }}</td>
                                        <td>R$ {{ number_format($folha->salario_base, 2, ',', '.') }}</td>
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
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('folhaPagamento.show', $folha) }}" 
                                                   class="btn btn-sm btn-info" title="Visualizar">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('folhaPagamento.edit', $folha) }}" 
                                                   class="btn btn-sm btn-warning" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('folhaPagamento.destroy', $folha) }}" 
                                                      method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            title="Excluir" 
                                                            onclick="return confirm('Tem certeza que deseja excluir esta folha de pagamento?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Nenhuma folha de pagamento encontrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($folhasPagamento->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $folhasPagamento->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 