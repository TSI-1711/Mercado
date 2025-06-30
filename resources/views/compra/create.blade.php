<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Nova Compra</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    <header style="max-width: 768px; margin: 0 auto;">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #1f2937; margin-bottom: 20px;">Nova Compra</h1>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">
        <form method="POST" action="{{ route('compra.store') }}" style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgb(0 0 0 / 0.1); display: flex; flex-direction: column; gap: 16px;">
            @csrf

            <div>
                <label for="fornecedor_id" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Fornecedor:</label>
                <select name="fornecedor_id" id="fornecedor_id" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;">
                    @foreach($fornecedores as $f)
                        <option value="{{ $f->id }}">{{ $f->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="descricao" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="3" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required></textarea>
            </div>

            <div>
                <label for="data" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Data:</label>
                <input name="data" id="data" type="date" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div>
                <label for="valor_total" style="display: block; font-weight: 500; font-size: 0.875rem; color: #374151;">Valor Total:</label>
                <input name="valor_total" id="valor_total" type="number" step="0.01" style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;" required>
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <button type="submit" style="background-color: #16a34a; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">Salvar</button>
            </div>
        </form>
    </main>

</body>
</html>