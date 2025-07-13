@extends('template')

@section('conteudo')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Nova Venda</h3>
                    <div class="card-tools">
                        <a href="{{ route('vendas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
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

                    <form action="{{ route('vendas.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cliente_id">Cliente *</label>
                                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                                        <option value="">Selecione um cliente</option>
                                        @foreach($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->nome }} - {{ $cliente->cpf_cnpj }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="data_venda">Data da Venda *</label>
                                    <input type="date" name="data_venda" id="data_venda" class="form-control" value="{{ old('data_venda', date('Y-m-d')) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="observacoes">Observações</label>
                            <textarea name="observacoes" id="observacoes" class="form-control" rows="3">{{ old('observacoes') }}</textarea>
                        </div>

                        <hr>

                        <h5>Produto</h5>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="produto_id">Produto *</label>
                                    <select name="produto_id" id="produto_id" class="form-control" required>
                                        <option value="">Selecione um produto</option>
                                        @foreach($produtos as $produto)
                                            <option value="{{ $produto->id }}" data-preco="{{ $produto->preco_custo }}" data-estoque="{{ $produto->estoque }}">
                                                {{ $produto->nome }} - Estoque: {{ $produto->estoque }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="quantidade">Quantidade *</label>
                                    <input type="number" name="quantidade" id="quantidade" class="form-control" min="1" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="preco_unitario">Preço Unitário *</label>
                                    <input type="number" name="preco_unitario" id="preco_unitario" class="form-control" step="0.01" min="0" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="subtotal">Subtotal</label>
                                    <input type="text" id="subtotal" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6 offset-md-6">
                                <div class="form-group">
                                    <label for="valor_total">Valor Total</label>
                                    <input type="text" id="valor_total" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Salvar Venda
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
    const produtoSelect = document.getElementById('produto_id');
    const quantidade = document.getElementById('quantidade');
    const precoUnitario = document.getElementById('preco_unitario');
    const subtotal = document.getElementById('subtotal');
    const valorTotal = document.getElementById('valor_total');

    produtoSelect.addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        if (option.dataset.preco) {
            precoUnitario.value = option.dataset.preco;
            calcularSubtotal();
        }
    });

    quantidade.addEventListener('input', function() {
        calcularSubtotal();
    });

    precoUnitario.addEventListener('input', function() {
        calcularSubtotal();
    });

    function calcularSubtotal() {
        const qtd = parseFloat(quantidade.value) || 0;
        const preco = parseFloat(precoUnitario.value) || 0;
        const subtotalValue = qtd * preco;

        subtotal.value = subtotalValue.toFixed(2);
        valorTotal.value = 'R$ ' + subtotalValue.toFixed(2);
    }
});
</script>
@endsection
