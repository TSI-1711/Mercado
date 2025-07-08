<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Conta a Pagar</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    @extends('template')

    <header style="max-width: 768px; margin: 0 auto;">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #1f2937; margin-bottom: 20px;">Editar Conta a Pagar</h1>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">

        {{-- Exibir mensagens de erro de validação --}}
        @if ($errors->any())
            <div style="background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('contas_pagar.update', $contas_pagar->id) }}" style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgb(0 0 0 / 0.1); display: flex; flex-direction: column; gap: 16px;">
            @csrf
            @method('PUT')

            <div>
                <label for="compra_id" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Compra Relacionada (opcional):</label>
                <select name="compra_id" id="compra_id" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
                    <option value="">-- Nenhuma --</option>
                    @foreach($compras as $compra)
                        <option value="{{ $compra->id }}" {{ (old('compra_id', $contas_pagar->compra_id) == $compra->id) ? 'selected' : '' }}>
                            {{ $compra->descricao }} - {{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="tipo_despesa_id" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Tipo de Despesa:</label>
                <select name="tipo_despesa_id" id="tipo_despesa_id" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
                    <option value="">-- Selecione --</option>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id }}" {{ (old('tipo_despesa_id', $contas_pagar->tipo_despesa_id) == $tipo->id) ? 'selected' : '' }}>
                            {{ $tipo->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="valor" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Valor:</label>
                <input name="valor" id="valor" type="number" step="0.01" value="{{ old('valor', $contas_pagar->valor) }}" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div>
                <label for="data_vencimento" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Data de Vencimento:</label>
                <input name="data_vencimento" id="data_vencimento" type="date" value="{{ old('data_vencimento', $contas_pagar->data_vencimento ? $contas_pagar->data_vencimento->format('Y-m-d') : '') }}" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div>
                <label for="pago" style="display: inline-flex; align-items: center; gap: 8px; font-weight: 500; font-size: 0.875rem; color: #374151;">
                    <input
                        type="checkbox"
                        name="pago"
                        id="pago"
                        value="1"
                        {{ old('pago', $contas_pagar->pago) ? 'checked' : '' }}
                        style="width: 16px; height: 16px;"
                    />
                    Pago
                </label>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <a href="{{ route('contas_pagar.index') }}" style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600; text-decoration: none; margin-right: 10px;">Cancelar</a>
                <button type="submit" style="background-color: #16a34a; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">Salvar</button>
            </div>
        </form>
    </main>

</body>
</html>