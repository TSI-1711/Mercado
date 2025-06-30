<x-app-layout>
    <x-slot name="header">Compras</x-slot>
    <div class="max-w-7xl mx-auto py-6">
        <a href="{{ route('compra.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Nova Compra</a>
        <ul class="mt-4 bg-white p-4 shadow rounded">
            @foreach($compras as $compra)
                <li>{{ $compra->fornecedor->nome }} - {{ $compra->data }}</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>