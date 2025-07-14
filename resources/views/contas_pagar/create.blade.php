<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Nova Conta a Pagar</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    @extends('template')

    <header style="max-width: 768px; margin: 0 auto 20px; margin-top: 60px;">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #1f2937;">Nova Conta a Pagar</h1>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">
        <form method="POST" action="{{ route('contas_pagar.store') }}" style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgb(0 0 0 / 0.1); display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 4px; font-weight: 500;">Compra (opcional)</label>
                <select name="compra_id" id="compra_id" class="w-full rounded border-gray-300" 
                        style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;"
                        onchange="atualizarValorCompra()">
                    <option value="">-- Nenhuma --</option>
                    @foreach($compras as $compra)
                        @php
                            // Garante que a data seja um objeto Carbon antes de formatar
                            $dataVencimento = is_string($compra->data_vencimento) 
                                ? \Carbon\Carbon::parse($compra->data_vencimento)
                                : $compra->data_vencimento;
                        @endphp
                        
                        <option value="{{ $compra->id }}" 
                                data-valor="{{ $compra->valor_total }}"
                                data-vencimento="{{ $dataVencimento->format('Y-m-d') }}">
                            {{ $compra->id }} - {{ $compra->descricao }} (R$ {{ number_format($compra->valor_total, 2, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Tipo de Despesa:</label>
                <select name="tipo_despesa_id" class="w-full rounded border-gray-300" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display: block; margin-bottom: 4px; font-weight: 500;">Valor</label>
                <input 
                    type="text" 
                    name="valor" 
                    id="valor"
                    value="{{ old('valor') }}" 
                    class="w-full rounded border-gray-300" 
                    style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" 
                    required
                >
            </div>

            <div>
                <label>Data de Vencimento:</label>
                <input type="date" 
                name="data_vencimento" 
                id="data_vencimento"
                value="{{ old('valor') }}"
                required class="w-full rounded border-gray-300" 
                style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
            </div>

            <div>
                <label>Pago?</label>
                <input type="checkbox" name="pago" value="1" style="margin-left: 8px;">
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" style="background-color: #16a34a; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">Salvar</button>
            </div>
        </form>
    </main>

    <script>
        function atualizarValorCompra() {
            const selectCompra = document.getElementById('compra_id');
            const inputValor = document.getElementById('valor');
            const inputDataVencimento = document.getElementById('data_vencimento');
            
            if(selectCompra.value) {
                // Obtém o valor da compra e data de vencimento
                const valorCompra = selectCompra.options[selectCompra.selectedIndex].getAttribute('data-valor');
                const dataVencimento = selectCompra.options[selectCompra.selectedIndex].getAttribute('data-vencimento');

                // Remove formatação para enviar ao servidor
                inputValor.value = valorCompra; // Envia o valor cru (ex: 1234.56)

                // Define a data de vencimento
                if(dataVencimento) {
                    inputDataVencimento.value = dataVencimento;
                }
            } else {
                // Limpa os campos se nenhuma compra for selecionada
                inputValor.value = '';
            }
        }                               
    </script>

</body>
</html>