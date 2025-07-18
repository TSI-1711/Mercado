@extends('template')

@section('conteudo')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Nova Entrada de Produtos</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('entradas.store') }}" method="POST" id="entradaForm">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="compra_id" class="form-label">Compra *</label>
                                    <select class="form-select @error('compra_id') is-invalid @enderror" 
                                            id="compra_id" name="compra_id" required>
                                        <option value="">Selecione uma compra</option>
                                        @foreach($compras as $compra)
                                            <option value="{{ $compra->id }}" {{ old('compra_id') == $compra->id ? 'selected' : '' }}>
                                                #{{ $compra->id }} - {{ $compra->fornecedor->nome }} ({{ $compra->status }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('compra_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="data_entrada" class="form-label">Data da Entrada *</label>
                                    <input type="date" class="form-control @error('data_entrada') is-invalid @enderror" 
                                           id="data_entrada" name="data_entrada" value="{{ old('data_entrada', date('Y-m-d')) }}" required>
                                    @error('data_entrada')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="observacoes" class="form-label">Observações</label>
                            <textarea class="form-control @error('observacoes') is-invalid @enderror" 
                                      id="observacoes" name="observacoes" rows="3">{{ old('observacoes') }}</textarea>
                            @error('observacoes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>
                        <h5>Itens Recebidos</h5>
                        
                        <div id="itens-container">
                            <!-- Os itens serão carregados dinamicamente baseado na compra selecionada -->
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('entradas.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Registrar Entrada
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const compraSelect = document.getElementById('compra_id');
    const itensContainer = document.getElementById('itens-container');
    
    compraSelect.addEventListener('change', function() {
        const compraId = this.value;
        if (compraId) {
            // Fazer requisição AJAX para buscar os itens da compra
            fetch(`/compras/${compraId}/itens`)
                .then(response => response.json())
                .then(data => {
                    itensContainer.innerHTML = '';
                    
                    data.itens.forEach((item, index) => {
                        const itemHtml = `
                            <div class="row item-row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Produto</label>
                                    <input type="text" class="form-control" value="${item.produto.nome}" readonly>
                                    <input type="hidden" name="itens[${index}][produto_id]" value="${item.produto_id}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Quantidade Pedida</label>
                                    <input type="number" class="form-control" value="${item.quantidade}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Quantidade Recebida *</label>
                                    <input type="number" min="0" max="${item.quantidade}" class="form-control quantidade-recebida" 
                                           name="itens[${index}][quantidade_recebida]" value="${item.quantidade}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Preço Unitário</label>
                                    <input type="text" class="form-control" value="R$ ${parseFloat(item.preco_unitario).toFixed(2).replace('.', ',')}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Subtotal</label>
                                    <input type="text" class="form-control subtotal-display" readonly>
                                </div>
                            </div>
                        `;
                        itensContainer.innerHTML += itemHtml;
                    });
                    
                    // Configurar eventos para calcular subtotais
                    setupSubtotalEvents();
                })
                .catch(error => {
                    console.error('Erro ao carregar itens:', error);
                    itensContainer.innerHTML = '<div class="alert alert-warning">Erro ao carregar itens da compra.</div>';
                });
        } else {
            itensContainer.innerHTML = '';
        }
    });
    
    function setupSubtotalEvents() {
        document.querySelectorAll('.quantidade-recebida').forEach(input => {
            input.addEventListener('input', function() {
                const row = this.closest('.item-row');
                const quantidade = parseFloat(this.value) || 0;
                const precoUnitario = parseFloat(row.querySelector('input[readonly]').value.replace('R$ ', '').replace(',', '.')) || 0;
                const subtotal = quantidade * precoUnitario;
                
                row.querySelector('.subtotal-display').value = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;
            });
        });
    }
});
</script>
@endsection 