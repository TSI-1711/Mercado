@extends('template')

@section('conteudo')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Editar Orçamento</h4>
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

                    <form action="{{ route('orcamentos.update', $orcamento->id) }}" method="POST" id="orcamentoForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="fornecedor_id" class="form-label">Fornecedor *</label>
                                    <select class="form-select @error('fornecedor_id') is-invalid @enderror" 
                                            id="fornecedor_id" name="fornecedor_id" required>
                                        <option value="">Selecione um fornecedor</option>
                                        @foreach($fornecedores as $fornecedor)
                                            <option value="{{ $fornecedor->id }}" {{ old('fornecedor_id', $orcamento->fornecedor_id) == $fornecedor->id ? 'selected' : '' }}>
                                                {{ $fornecedor->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fornecedor_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="data_orcamento" class="form-label">Data do Orçamento *</label>
                                    <input type="date" class="form-control @error('data_orcamento') is-invalid @enderror" 
                                           id="data_orcamento" name="data_orcamento" value="{{ old('data_orcamento', $orcamento->data_orcamento) }}" required>
                                    @error('data_orcamento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>Itens do Orçamento</h5>
                        <div id="itens-container">
                            @foreach($orcamento->itens as $index => $item)
                            <div class="row item-row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Produto *</label>
                                    <select class="form-select produto-select" name="itens[{{ $index }}][produto_id]" required>
                                        <option value="">Selecione um produto</option>
                                        @foreach($produtos as $produto)
                                            <option value="{{ $produto->id }}" data-preco="{{ $produto->preco_custo }}" {{ $item->produto_id == $produto->id ? 'selected' : '' }}>
                                                {{ $produto->nome }} - R$ {{ number_format($produto->preco_custo, 2, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Quantidade *</label>
                                    <input type="number" min="1" class="form-control quantidade-input" 
                                           name="itens[{{ $index }}][quantidade]" value="{{ $item->quantidade }}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Preço Unit. *</label>
                                    <input type="number" step="0.01" min="0" class="form-control preco-input" 
                                           name="itens[{{ $index }}][preco_unitario]" value="{{ $item->preco_unitario }}" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Subtotal</label>
                                    <input type="text" class="form-control subtotal-display" value="R$ {{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">&nbsp;</label>
                                    <button type="button" class="btn btn-danger btn-remove-item d-block">
                                        <i class="bi bi-trash"></i> Remover
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-success" id="btn-add-item">
                                <i class="bi bi-plus-circle"></i> Adicionar Item
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">Resumo</h6>
                                        <div class="d-flex justify-content-between">
                                            <strong>Total:</strong>
                                            <span id="valor-total">R$ {{ number_format($orcamento->valor_total, 2, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('orcamentos.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Salvar Alterações
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
    let itemIndex = {{ $orcamento->itens->count() }};
    document.getElementById('btn-add-item').addEventListener('click', function() {
        const container = document.getElementById('itens-container');
        const newRow = document.querySelector('.item-row').cloneNode(true);
        newRow.querySelector('.produto-select').value = '';
        newRow.querySelector('.quantidade-input').value = '1';
        newRow.querySelector('.preco-input').value = '';
        newRow.querySelector('.subtotal-display').value = '';
        newRow.querySelector('.produto-select').name = `itens[${itemIndex}][produto_id]`;
        newRow.querySelector('.quantidade-input').name = `itens[${itemIndex}][quantidade]`;
        newRow.querySelector('.preco-input').name = `itens[${itemIndex}][preco_unitario]`;
        container.appendChild(newRow);
        itemIndex++;
        setupItemEvents(newRow);
    });
    function setupItemEvents(row) {
        const produtoSelect = row.querySelector('.produto-select');
        const quantidadeInput = row.querySelector('.quantidade-input');
        const precoInput = row.querySelector('.preco-input');
        const subtotalDisplay = row.querySelector('.subtotal-display');
        const removeBtn = row.querySelector('.btn-remove-item');
        produtoSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const preco = selectedOption.dataset.preco;
            if (preco) {
                precoInput.value = preco;
                calcularSubtotal();
            }
        });
        quantidadeInput.addEventListener('input', calcularSubtotal);
        precoInput.addEventListener('input', calcularSubtotal);
        removeBtn.addEventListener('click', function() {
            if (document.querySelectorAll('.item-row').length > 1) {
                row.remove();
                calcularTotal();
            }
        });
        function calcularSubtotal() {
            const quantidade = parseFloat(quantidadeInput.value) || 0;
            const preco = parseFloat(precoInput.value) || 0;
            const subtotal = quantidade * preco;
            subtotalDisplay.value = `R$ ${subtotal.toFixed(2).replace('.', ',')}`;
            calcularTotal();
        }
    }
    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('.item-row').forEach(row => {
            const quantidade = parseFloat(row.querySelector('.quantidade-input').value) || 0;
            const preco = parseFloat(row.querySelector('.preco-input').value) || 0;
            total += quantidade * preco;
        });
        document.getElementById('valor-total').textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
    }
    document.querySelectorAll('.item-row').forEach(row => setupItemEvents(row));
});
</script>
@endsection 