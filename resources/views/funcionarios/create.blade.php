@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Novo Funcionário</h3>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('funcionarios.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nome">Nome Completo *</label>
                                    <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                                           id="nome" name="nome" value="{{ old('nome') }}" required>
                                    @error('nome')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cpf">CPF *</label>
                                    <input type="text" class="form-control @error('cpf') is-invalid @enderror" 
                                           id="cpf" name="cpf" value="{{ old('cpf') }}" required>
                                    @error('cpf')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="rg">RG</label>
                                    <input type="text" class="form-control @error('rg') is-invalid @enderror" 
                                           id="rg" name="rg" value="{{ old('rg') }}">
                                    @error('rg')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="data_nascimento">Data de Nascimento *</label>
                                    <input type="date" class="form-control @error('data_nascimento') is-invalid @enderror" 
                                           id="data_nascimento" name="data_nascimento" value="{{ old('data_nascimento') }}" required>
                                    @error('data_nascimento')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="telefone">Telefone *</label>
                                    <input type="text" class="form-control @error('telefone') is-invalid @enderror" 
                                           id="telefone" name="telefone" value="{{ old('telefone') }}" required>
                                    @error('telefone')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="cargo">Cargo *</label>
                                    <input type="text" class="form-control @error('cargo') is-invalid @enderror" 
                                           id="cargo" name="cargo" value="{{ old('cargo') }}" required>
                                    @error('cargo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="data_admissao">Data de Admissão *</label>
                                    <input type="date" class="form-control @error('data_admissao') is-invalid @enderror" 
                                           id="data_admissao" name="data_admissao" value="{{ old('data_admissao') }}" required>
                                    @error('data_admissao')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="salario_base">Salário Base *</label>
                                    <input type="number" step="0.01" class="form-control @error('salario_base') is-invalid @enderror" 
                                           id="salario_base" name="salario_base" value="{{ old('salario_base') }}" required>
                                    @error('salario_base')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="valor_hora_extra">Valor Hora Extra</label>
                                    <input type="number" step="0.01" class="form-control @error('valor_hora_extra') is-invalid @enderror" 
                                           id="valor_hora_extra" name="valor_hora_extra" value="{{ old('valor_hora_extra') }}">
                                    @error('valor_hora_extra')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="banco">Banco</label>
                                    <input type="text" class="form-control @error('banco') is-invalid @enderror" 
                                           id="banco" name="banco" value="{{ old('banco') }}">
                                    @error('banco')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="agencia">Agência</label>
                                    <input type="text" class="form-control @error('agencia') is-invalid @enderror" 
                                           id="agencia" name="agencia" value="{{ old('agencia') }}">
                                    @error('agencia')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="conta">Conta</label>
                                    <input type="text" class="form-control @error('conta') is-invalid @enderror" 
                                           id="conta" name="conta" value="{{ old('conta') }}">
                                    @error('conta')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="ativo" name="ativo" value="1" 
                                               {{ old('ativo', 1) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="ativo">Funcionário Ativo</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Salvar Funcionário
                                    </button>
                                    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Voltar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 