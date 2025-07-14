@extends('template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Nova Ocorrência</h3>
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

                    <form action="{{ route('ocorrencias.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="funcionario_id">Funcionário *</label>
                                    <select class="form-control @error('funcionario_id') is-invalid @enderror" 
                                            id="funcionario_id" name="funcionario_id" required>
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
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tipo">Tipo *</label>
                                    <select class="form-control @error('tipo') is-invalid @enderror" 
                                            id="tipo" name="tipo" required>
                                        <option value="">Selecione o tipo</option>
                                        @foreach(App\Models\Ocorrencias::TIPOS as $key => $value)
                                            <option value="{{ $key }}" {{ old('tipo') == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipo')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="data">Data *</label>
                                    <input type="date" class="form-control @error('data') is-invalid @enderror" 
                                           id="data" name="data" value="{{ old('data', date('Y-m-d')) }}" required>
                                    @error('data')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="hora_inicio">Hora Início</label>
                                    <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror" 
                                           id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}">
                                    @error('hora_inicio')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="hora_fim">Hora Fim</label>
                                    <input type="time" class="form-control @error('hora_fim') is-invalid @enderror" 
                                           id="hora_fim" name="hora_fim" value="{{ old('hora_fim') }}">
                                    @error('hora_fim')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="quantidade_horas">Quantidade de Horas</label>
                                    <input type="number" step="0.5" class="form-control @error('quantidade_horas') is-invalid @enderror" 
                                           id="quantidade_horas" name="quantidade_horas" value="{{ old('quantidade_horas') }}">
                                    @error('quantidade_horas')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="status">Status *</label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        @foreach(App\Models\Ocorrencias::STATUS as $key => $value)
                                            <option value="{{ $key }}" {{ old('status', 'pendente') == $key ? 'selected' : '' }}>
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
                                    <label for="descricao">Descrição</label>
                                    <textarea class="form-control @error('descricao') is-invalid @enderror" 
                                              id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
                                    @error('descricao')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Salvar Ocorrência
                                    </button>
                                    <a href="{{ route('ocorrencias.index') }}" class="btn btn-secondary">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const horaInicio = document.getElementById('hora_inicio');
    const horaFim = document.getElementById('hora_fim');
    const quantidadeHoras = document.getElementById('quantidade_horas');
    
    function calcularHoras() {
        if (horaInicio.value && horaFim.value) {
            const inicio = new Date('2000-01-01T' + horaInicio.value);
            const fim = new Date('2000-01-01T' + horaFim.value);
            
            if (fim > inicio) {
                const diffMs = fim - inicio;
                const diffHours = diffMs / (1000 * 60 * 60);
                quantidadeHoras.value = diffHours.toFixed(2);
            }
        }
    }
    
    horaInicio.addEventListener('change', calcularHoras);
    horaFim.addEventListener('change', calcularHoras);
});
</script>
@endsection 