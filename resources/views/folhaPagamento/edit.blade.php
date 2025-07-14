@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editar Folha de Pagamento</h3>
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

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        <strong>Atenção:</strong> Os valores da folha de pagamento são calculados automaticamente baseados nas ocorrências aprovadas. 
                        Apenas observações e status podem ser editados manualmente.
                    </div>

                    <form action="{{ route('folhaPagamento.update', $folhaPagamento) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Funcionário</label>
                                    <input type="text" class="form-control" value="{{ $folhaPagamento->funcionario ? $folhaPagamento->funcionario->nome : 'Funcionário excluído' }}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mês/Ano</label>
                                    <input type="text" class="form-control" value="{{ $folhaPagamento->mes_referencia }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Salário Base</label>
                                    <input type="text" class="form-control" value="R$ {{ number_format($folhaPagamento->salario_base, 2, ',', '.') }}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Salário Bruto</label>
                                    <input type="text" class="form-control" value="R$ {{ number_format($folhaPagamento->salario_bruto, 2, ',', '.') }}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Salário Líquido</label>
                                    <input type="text" class="form-control" value="R$ {{ number_format($folhaPagamento->salario_liquido, 2, ',', '.') }}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        @foreach($folhaPagamento::STATUS as $key => $value)
                                            <option value="{{ $key }}" {{ old('status', $folhaPagamento->status) == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="observacoes">Observações</label>
                                    <textarea class="form-control @error('observacoes') is-invalid @enderror" 
                                              id="observacoes" name="observacoes" rows="3">{{ old('observacoes', $folhaPagamento->observacoes) }}</textarea>
                                    @error('observacoes')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Atualizar Folha
                                    </button>
                                    <a href="{{ route('folhaPagamento.index') }}" class="btn btn-secondary">
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