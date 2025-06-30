<x-app-layout>
    <x-slot name="header">Contas a Pagar</x-slot>
    <div class="max-w-7xl mx-auto py-6">
        <a href="{{ route('contas_pagar.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Nova Conta</a>
        <ul class="mt-4 bg-white p-4 shadow rounded">
            @foreach($contas as $c)
                <li>{{ $c->tipoDespesa->nome }} - R$ {{ $c->valor }} - {{ $c->data_vencimento }} - Pago: {{ $c->pago ? 'Sim' : 'Não' }}</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>