<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Novo Fornecedor
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('fornecedor.store') }}" method="POST" class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nome:</label>
                    <input type="text" name="nome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">CNPJ:</label>
                    <input type="text" name="cnpj" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Endereço:</label>
                    <input type="text" name="endereco" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Telefone:</label>
                    <input type="text" name="telefone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">E-mail:</label>
                    <input type="text" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>