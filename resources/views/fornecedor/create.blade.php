<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Novo Fornecedor</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f9fafb; padding: 20px;">

    @extends('template')

    <header style="max-width: 768px; margin: 0 auto 20px; margin-top: 60px;">
        <h1 style="font-weight: 600; font-size: 1.5rem; color: #1f2937;">Novo Fornecedor</h1>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">
        <form action="{{ route('fornecedor.store') }}" method="POST" style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgb(0 0 0 / 0.1); display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Nome:</label>
                <input type="text" name="nome" style="margin-top: 4px; width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
            </div>

            <div>
    <label class="block text-sm font-medium text-gray-700">CNPJ:</label>
    <input 
        type="text" 
        name="cnpj" 
        value="{{ old('cnpj') }}"
        oninvalid="this.setCustomValidity('Esse CNPJ já foi cadastrado.')" 
        oninput="this.setCustomValidity('')"
        required
        style="margin-top: 4px; width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;"
    >
    @error('cnpj')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const cnpjInput = document.querySelector('input[name="cnpj"]');
                if (cnpjInput) {
                    cnpjInput.setCustomValidity('{{ $message }}');
                    cnpjInput.reportValidity();
                }
            });
        </script>
    @enderror
</div>
            

            <div>
                <label class="block text-sm font-medium text-gray-700">Endereço:</label>
                <input type="text" name="endereco" style="margin-top: 4px; width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Telefone:</label>
                <input type="text" name="telefone" style="margin-top: 4px; width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">E-mail:</label>
                <input type="text" name="email" style="margin-top: 4px; width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
            </div>

            <div>
                <button type="submit" style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">
                    Salvar
                </button>
            </div>
        </form>
    </main>

</body>
</html>