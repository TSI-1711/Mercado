@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Funcionários</h3>
                    <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Novo Funcionário
                    </a>
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
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Cargo</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($funcionarios as $funcionario)
                                    <tr>
                                        <td>{{ $funcionario->id }}</td>
                                        <td>{{ $funcionario->nome }}</td>
                                        <td>{{ $funcionario->cpf }}</td>
                                        <td>{{ $funcionario->cargo }}</td>
                                        <td>{{ $funcionario->email }}</td>
                                        <td>{{ $funcionario->telefone }}</td>
                                        <td>
                                            @if($funcionario->ativo)
                                                <span class="badge bg-success">Ativo</span>
                                            @else
                                                <span class="badge bg-danger">Inativo</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('funcionarios.show', $funcionario) }}" 
                                                   class="btn btn-sm btn-info" title="Visualizar">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('funcionarios.edit', $funcionario) }}" 
                                                   class="btn btn-sm btn-warning" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('funcionarios.destroy', $funcionario) }}" 
                                                      method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            title="Excluir" 
                                                            onclick="return confirm('Tem certeza que deseja excluir este funcionário?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Nenhum funcionário encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($funcionarios->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $funcionarios->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 