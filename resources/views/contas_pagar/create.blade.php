<x-app-layout>
    <x-slot name="header">Nova Conta a Pagar</x-slot>
    <div class="max-w-7xl mx-auto py-6">
        <form method="POST" action="{{ route('contas_pagar.store') }}" class="bg-white p-6 rounded shadow space-y-4">
            @csrf
            <div>
                <label>Compra (opcional):</label>
                <select name="compra_id" class="w-full rounded border-gray-300">
                    <option value="">-- Nenhuma --</option>
                    @foreach($compras as $compra)
                        <option value="{{ $compra->id }}">{{ $compra->id }} - {{ $compra->data }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Tipo de Despesa:</label>
                <select name="tipo_despesa_id" class="w-full rounded border-gray-300">
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>Valor:</label>
                <input type="number" name="valor" step="0.01" class="w-full rounded border-gray-300" required>
            </div>
            <div>
                <label>Data de Vencimento:</label>
                <input type="date" name="data_vencimento" class="w-full rounded border-gray-300" required>
            </div>
            <div>
                <label>Pago?</label>
                <input type="checkbox" name="pago" value="1">
            </div>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Salvar</button>
        </form>
    </div>
</x-app-layout>