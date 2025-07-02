@extends('template')

@section('conteudo')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Clientes</h4>
                    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Novo Cliente
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($clientes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th>CPF/CNPJ</th>
                                        <th>Cidade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->nome }}</td>
                                        <td>{{ $cliente->email ?? '-' }}</td>
                                        <td>{{ $cliente->telefone ?? '-' }}</td>
                                        <td>{{ $cliente->cpf_cnpj ?? '-' }}</td>
                                        <td>{{ $cliente->cidade ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('clientes.show', $cliente) }}" 
                                                   class="btn btn-sm btn-info" title="Visualizar">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('clientes.edit', $cliente) }}" 
                                                   class="btn btn-sm btn-warning" title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('clientes.destroy', $cliente) }}" 
                                                      method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            title="Remover" 
                                                            onclick="return confirm('Tem certeza que deseja remover este cliente?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-people display-1 text-muted"></i>
                            <h5 class="mt-3 text-muted">Nenhum cliente cadastrado</h5>
                            <p class="text-muted">Clique em "Novo Cliente" para começar a cadastrar.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 