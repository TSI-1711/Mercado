<x-app-layout>
    <x-slot name="header">Novo Tipo de Despesa</x-slot>
    <div class="max-w-7xl mx-auto py-6">
        <form method="POST" action="{{ route('tipo_despesa.store') }}" class="bg-white p-6 rounded shadow space-y-4">
            @csrf
            <div>
                <label>Nome:</label>
                <input type="text" name="nome" class="w-full rounded border-gray-300" required>
            </div>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Salvar</button>
        </form>
    </div>