@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Ocorrências</h3>
                    <a href="{{ route('ocorrencias.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nova Ocorrência
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
                                    <th>Funcionário</th>
                                    <th>Tipo</th>
                                    <th>Data</th>
                                    <th>Horas</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ocorrencias as $ocorrencia)
                                    <tr>
                                        <td>{{ $ocorrencia->id }}</td>
                                        <td>{{ $ocorrencia->funcionario ? $ocorrencia->funcionario->nome : 'Funcionário excluído' }}</td>
                                        <td>
                                            @if($ocorrencia->tipo == 'hora_extra')
                                                <span class="badge bg-success">{{ $ocorrencia::TIPOS[$ocorrencia->tipo] }}</span>
                                            @elseif($ocorrencia->tipo == 'falta')
                                                <span class="badge bg-danger">{{ $ocorrencia::TIPOS[$ocorrencia->tipo] }}</span>
                                            @elseif($ocorrencia->tipo == 'atraso')
                                                <span class="badge bg-warning text-dark">{{ $ocorrencia::TIPOS[$ocorrencia->tipo] }}</span>
                                            @else
                                                <span class="badge bg-info text-dark">{{ $ocorrencia::TIPOS[$ocorrencia->tipo] }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $ocorrencia->data ? $ocorrencia->data->format('d/m/Y') : '' }}</td>
                                        <td>
                                            @if($ocorrencia->quantidade_horas)
                                                {{ number_format($ocorrencia->quantidade_horas, 2) }}h
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if($ocorrencia->valor_calculado)
                                                R$ {{ number_format($ocorrencia->valor_calculado, 2, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                                                    @if($ocorrencia->status == 'pendente')
                            <span class="badge bg-warning text-dark">{{ $ocorrencia::STATUS[$ocorrencia->status] }}</span>
                        @elseif($ocorrencia->status == 'aprovada')
                            <span class="badge bg-success">{{ $ocorrencia::STATUS[$ocorrencia->status] }}</span>
                        @elseif($ocorrencia->status == 'rejeitada')
                            <span class="badge bg-danger">{{ $ocorrencia::STATUS[$ocorrencia->status] }}</span>
                        @else
                            <span class="badge bg-info text-dark">{{ $ocorrencia::STATUS[$ocorrencia->status] }}</span>
                        @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('ocorrencias.show', $ocorrencia) }}" 
                                                   class="btn btn-sm btn-info" title="Visualizar">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('ocorrencias.edit', $ocorrencia) }}" 
                                                   class="btn btn-sm btn-warning" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('ocorrencias.destroy', $ocorrencia) }}" 
                                                      method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            title="Excluir" 
                                                            onclick="return confirm('Tem certeza que deseja excluir esta ocorrência?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Nenhuma ocorrência encontrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($ocorrencias->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $ocorrencias->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 