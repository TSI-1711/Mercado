@extends('template')

@section('conteudo')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detalhes do Cliente</h4>
                    <div>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning me-2">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <h5 class="text-primary">{{ $cliente->nome }}</h5>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email:</label>
                            <p class="form-control-plaintext">{{ $cliente->email ?? 'Não informado' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Telefone:</label>
                            <p class="form-control-plaintext">{{ $cliente->telefone ?? 'Não informado' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">CPF/CNPJ:</label>
                            <p class="form-control-plaintext">{{ $cliente->cpf_cnpj ?? 'Não informado' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">CEP:</label>
                            <p class="form-control-plaintext">{{ $cliente->cep ?? 'Não informado' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Endereço:</label>
                            <p class="form-control-plaintext">{{ $cliente->endereco ?? 'Não informado' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-bold">Cidade:</label>
                            <p class="form-control-plaintext">{{ $cliente->cidade ?? 'Não informado' }}</p>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Estado:</label>
                            <p class="form-control-plaintext">{{ $cliente->estado ?? 'Não informado' }}</p>
                        </div>
                    </div>

                    @if($cliente->observacoes)
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-bold">Observações:</label>
                            <p class="form-control-plaintext">{{ $cliente->observacoes }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Data de Cadastro:</label>
                            <p class="form-control-plaintext">{{ $cliente->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Última Atualização:</label>
                            <p class="form-control-plaintext">{{ $cliente->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Tem certeza que deseja remover este cliente?')">
                                <i class="bi bi-trash"></i> Remover Cliente
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 