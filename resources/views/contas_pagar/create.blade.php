<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Nova Conta a Pagar</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    <header style="max-width: 768px; margin: 0 auto 20px;">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #1f2937;">Nova Conta a Pagar</h1>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">
        <form method="POST" action="{{ route('contas_pagar.store') }}" style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgb(0 0 0 / 0.1); display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <div>
                <label>Compra (opcional):</label>
                <select name="compra_id" class="w-full rounded border-gray-300" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
                    <option value="">-- Nenhuma --</option>
                    @foreach($compras as $compra)
                        <option value="{{ $compra->id }}">{{ $compra->id }} - {{ $compra->data }}</option>
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

            <div>
                <label>Valor:</label>
                <input type="number" name="valor" step="0.01" required class="w-full rounded border-gray-300" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
            </div>

            <div>
                <label>Data de Vencimento:</label>
                <input type="date" name="data_vencimento" required class="w-full rounded border-gray-300" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
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

</body>
</html