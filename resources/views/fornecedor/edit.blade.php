<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Fornecedor</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px; margin-top: 60px;">

    @extends('template')

    <header style="max-width: 768px; margin: 0 auto;">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #1f2937; margin-bottom: 20px;">Editar Fornecedor</h1>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">

        {{-- Mensagens de erro de validação --}}
        @if ($errors->any())
            <div style="background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('fornecedor.update', $fornecedor->id) }}" method="POST" style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; gap: 16px;">
            @csrf
            @method('PUT')

            <div>
                <label for="nome" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Nome:</label>
                <input type="text" id="nome" name="nome" value="{{ old('nome', $fornecedor->nome) }}" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div>
                <label for="cnpj" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">CNPJ:</label>
                <input type="text" id="cnpj" name="cnpj" value="{{ old('cnpj', $fornecedor->cnpj) }}" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div>
                <label for="endereco" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="{{ old('endereco', $fornecedor->endereco) }}" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div>
                <label for="telefone" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $fornecedor->telefone) }}" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div>
                <label for="email" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">E-mail:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $fornecedor->email) }}" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 8px;">
                <a href="{{ route('fornecedor.index') }}" style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600; text-decoration: none;">Cancelar</a>

                <button type="submit" style="background-color: #16a34a; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">
                    Salvar
                </button>
            </div>
        </form>
    </main>

</body>
</html>