@extends('template')

@section('conteudo')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Orçamentos</h2>
                <a href="{{ route('orcamentos.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Novo Orçamento
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Fornecedor</th>
                                    <th>Data</th>
                                    <th>Valor Total</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orcamentos as $orcamento)
                                    <tr>
                                        <td>{{ $orcamento->id }}</td>
                                        <td>{{ $orcamento->fornecedor->nome }}</td>
                                        <td>{{ \Carbon\Carbon::parse($orcamento->data_orcamento)->format('d/m/Y') }}</td>
                                        <td>R$ {{ number_format($orcamento->valor_total, 2, ',', '.') }}</td>
                                        <td>
                                            <span class="badge {{ $orcamento->status === 'aprovado' ? 'bg-success' : ($orcamento->status === 'rejeitado' ? 'bg-danger' : 'bg-warning') }}">
                                                {{ ucfirst($orcamento->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('orcamentos.show', $orcamento->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('orcamentos.edit', $orcamento->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('orcamentos.destroy', $orcamento->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este orçamento?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Nenhum orçamento cadastrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $orcamentos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 