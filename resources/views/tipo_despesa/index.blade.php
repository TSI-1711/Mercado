<x-app-layout>
    <x-slot name="header">Tipos de Despesa</x-slot>
    <div class="max-w-7xl mx-auto py-6">
        <a href="{{ route('tipo_despesa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Novo Tipo</a>
        <ul class="mt-4 bg-white p-4 shadow rounded">
            @foreach($tipos as $tipo)
                <li>{{ $tipo->nome }}</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>