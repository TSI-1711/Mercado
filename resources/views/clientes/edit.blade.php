@extends('template')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Editar Cliente</h4>
                    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nome" class="form-label">Nome *</label>
                                <input type="text" class="form-control @error('nome') is-invalid @enderror" 
                                       id="nome" name="nome" value="{{ old('nome', $cliente->nome) }}" required>
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $cliente->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control @error('telefone') is-invalid @enderror" 
                                       id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone) }}">
                                @error('telefone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
                                <input type="text" class="form-control @error('cpf_cnpj') is-invalid @enderror" 
                                       id="cpf_cnpj" name="cpf_cnpj" value="{{ old('cpf_cnpj', $cliente->cpf_cnpj) }}">
                                @error('cpf_cnpj')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control @error('cep') is-invalid @enderror" 
                                       id="cep" name="cep" value="{{ old('cep', $cliente->cep) }}">
                                @error('cep')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control @error('endereco') is-invalid @enderror" 
                                       id="endereco" name="endereco" value="{{ old('endereco', $cliente->endereco) }}">
                                @error('endereco')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control @error('cidade') is-invalid @enderror" 
                                       id="cidade" name="cidade" value="{{ old('cidade', $cliente->cidade) }}">
                                @error('cidade')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="estado" class="form-label">Estado</label>
                                <select class="form-select @error('estado') is-invalid @enderror" 
                                        id="estado" name="estado">
                                    <option value="">Selecione...</option>
                                    <option value="AC" {{ old('estado', $cliente->estado) == 'AC' ? 'selected' : '' }}>Acre</option>
                                    <option value="AL" {{ old('estado', $cliente->estado) == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                    <option value="AP" {{ old('estado', $cliente->estado) == 'AP' ? 'selected' : '' }}>Amapá</option>
                                    <option value="AM" {{ old('estado', $cliente->estado) == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                    <option value="BA" {{ old('estado', $cliente->estado) == 'BA' ? 'selected' : '' }}>Bahia</option>
                                    <option value="CE" {{ old('estado', $cliente->estado) == 'CE' ? 'selected' : '' }}>Ceará</option>
                                    <option value="DF" {{ old('estado', $cliente->estado) == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                    <option value="ES" {{ old('estado', $cliente->estado) == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                    <option value="GO" {{ old('estado', $cliente->estado) == 'GO' ? 'selected' : '' }}>Goiás</option>
                                    <option value="MA" {{ old('estado', $cliente->estado) == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                    <option value="MT" {{ old('estado', $cliente->estado) == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                    <option value="MS" {{ old('estado', $cliente->estado) == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                    <option value="MG" {{ old('estado', $cliente->estado) == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                    <option value="PA" {{ old('estado', $cliente->estado) == 'PA' ? 'selected' : '' }}>Pará</option>
                                    <option value="PB" {{ old('estado', $cliente->estado) == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                    <option value="PR" {{ old('estado', $cliente->estado) == 'PR' ? 'selected' : '' }}>Paraná</option>
                                    <option value="PE" {{ old('estado', $cliente->estado) == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                    <option value="PI" {{ old('estado', $cliente->estado) == 'PI' ? 'selected' : '' }}>Piauí</option>
                                    <option value="RJ" {{ old('estado', $cliente->estado) == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                    <option value="RN" {{ old('estado', $cliente->estado) == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                    <option value="RS" {{ old('estado', $cliente->estado) == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                    <option value="RO" {{ old('estado', $cliente->estado) == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                    <option value="RR" {{ old('estado', $cliente->estado) == 'RR' ? 'selected' : '' }}>Roraima</option>
                                    <option value="SC" {{ old('estado', $cliente->estado) == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                    <option value="SP" {{ old('estado', $cliente->estado) == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                    <option value="SE" {{ old('estado', $cliente->estado) == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                    <option value="TO" {{ old('estado', $cliente->estado) == 'TO' ? 'selected' : '' }}>Tocantins</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="observacoes" class="form-label">Observações</label>
                                <textarea class="form-control @error('observacoes') is-invalid @enderror" 
                                          id="observacoes" name="observacoes" rows="3">{{ old('observacoes', $cliente->observacoes) }}</textarea>
                                @error('observacoes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('clientes.index') }}" class="btn btn-secondary me-md-2">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 