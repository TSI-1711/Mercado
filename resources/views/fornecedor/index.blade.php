<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Fornecedores
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('fornecedor.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Novo Fornecedor
            </a>

            <div class="mt-4 bg-white shadow-sm sm:rounded-lg p-4">
                <ul>
                    @foreach($fornecedores as $fornecedor)
                        <li>{{ $fornecedor->nome }} - {{ $fornecedor->cnpj }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>