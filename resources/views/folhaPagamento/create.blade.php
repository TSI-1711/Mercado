@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gerar Folha de Pagamento</h3>
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

                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('info') }}
                        </div>
                    @endif

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

                    <!-- Geração Automática -->
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-magic"></i> Geração Automática
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">
                                <strong>Gera automaticamente a folha de pagamento baseada nas ocorrências aprovadas do funcionário.</strong><br>
                                <small class="text-info">
                                    <i class="fas fa-info-circle"></i> 
                                    O sistema calculará automaticamente horas extras, faltas e descontos baseado nas ocorrências aprovadas.
                                </small>
                            </p>
                            <form action="{{ route('folhaPagamento.gerar') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="funcionario_id_auto">Funcionário *</label>
                                            <select class="form-control @error('funcionario_id') is-invalid @enderror" 
                                                    id="funcionario_id_auto" name="funcionario_id" required>
                                                <option value="">Selecione um funcionário</option>
                                                @foreach($funcionarios as $funcionario)
                                                    <option value="{{ $funcionario->id }}" 
                                                            {{ old('funcionario_id') == $funcionario->id ? 'selected' : '' }}>
                                                        {{ $funcionario->nome }} - {{ $funcionario->cargo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('funcionario_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mes_referencia_auto">Mês/Ano *</label>
                                            <input type="month" class="form-control @error('mes_referencia') is-invalid @enderror" 
                                                   id="mes_referencia_auto" name="mes_referencia" 
                                                   value="{{ old('mes_referencia', date('Y-m')) }}" required>
                                            @error('mes_referencia')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="fas fa-magic"></i> Gerar Automaticamente
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 