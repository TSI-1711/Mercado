<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Nova Compra</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    @extends('template')

    <header style="max-width: 768px; margin: 0 auto; margin-top: 60px;">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #1f2937; margin-bottom: 20px;">Nova Compra Interna</h1>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">

        {{-- Exibir mensagens de erro de validação --}}
        @if ($errors->any())
            <div style="background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('compra.store') }}" style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgb(0 0 0 / 0.1); display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <div>
                <label for="fornecedor_id" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Fornecedor:</label>
                <select name="fornecedor_id" id="fornecedor_id" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
                    @foreach($fornecedores as $f)
                        <option value="{{ $f->id }}">{{ $f->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="descricao" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="3" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>{{ old('descricao') }}</textarea>
            </div>

            <div>
                <label for="data_compra" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Data da Compra:</label>
                <input name="data_compra" id="data_compra" type="date" value="{{ old('data_compra') }}" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div>
                <label for="valor_total" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Valor Total:</label>
                <input name="valor_total" id="valor_total" type="number" step="0.01" value="{{ old('valor_total') }}" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" style="background-color: #16a34a; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">Salvar</button>
            </div>
        </form>
    </main>

</body>
</html>