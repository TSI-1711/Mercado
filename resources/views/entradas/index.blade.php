@extends('template')

@section('conteudo')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Entradas de Produtos</h2>
                <a href="{{ route('entradas.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Nova Entrada
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
                                    <th>Compra</th>
                                    <th>Fornecedor</th>
                                    <th>Data Entrada</th>
                                    <th>Itens Recebidos</th>
                                    <th>Observações</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($entradas as $entrada)
                                    <tr>
                                        <td>{{ $entrada->id }}</td>
                                        <td>#{{ $entrada->compra->id }}</td>
                                        <td>{{ $entrada->compra->fornecedor->nome }}</td>
                                        <td>{{ \Carbon\Carbon::parse($entrada->data_entrada)->format('d/m/Y') }}</td>
                                        <td>{{ $entrada->itens->count() }} itens</td>
                                        <td>{{ Str::limit($entrada->observacoes, 30) }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('entradas.show', $entrada->id) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('entradas.edit', $entrada->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('entradas.destroy', $entrada->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta entrada?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Nenhuma entrada registrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $entradas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 