<x-app-layout>
    <x-slot name="header">Nova Compra</x-slot>

    <div class="max-w-7xl mx-auto py-6">
        <form method="POST" action="{{ route('compra.store') }}" class="bg-white p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label for="fornecedor_id" class="block font-medium text-sm text-gray-700">Fornecedor:</label>
                <select name="fornecedor_id" id="fornecedor_id" class="w-full rounded border-gray-300">
                    @foreach($fornecedores as $f)
                        <option value="{{ $f->id }}">{{ $f->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="descricao" class="block font-medium text-sm text-gray-700">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="3" class="w-full rounded border-gray-300" required></textarea>
            </div>

            <div>
                <label for="data" class="block font-medium text-sm text-gray-700">Data:</label>
                <input name="data" id="data" type="date" class="w-full rounded border-gray-300" required>
            </div>

            <div>
                <label for="valor_total" class="block font-medium text-sm text-gray-700">Valor Total:</label>
                <input name="valor_total" id="valor_total" type="number" step="0.01" class="w-full rounded border-gray-300" required>
            </div>

            <div class="flex justify-end">
                <button class="bg-green-600 text-white px-4 py-2 rounded">Salvar</button>
            </div>
        </form>
    </div>
</x-app-layout>