<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Tipo de Despesa</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    @extends('template')

    <header style="max-width: 768px; margin: 0 auto 20px;">
        <h1 style="font-weight: 600; font-size: 1.5rem; color: #1f2937;">Editar Tipo de Despesa</h1>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">
        <form method="POST" action="{{ route('tipo_despesa.update', $tipo_despesa->id) }}" style="background: white; padding: 24px; border-radius: 8px; box-shadow: 0 1px 3px rgb(0 0 0 / 0.1); display: flex; flex-direction: column; gap: 16px;">
            @csrf
            @method('PUT')

            <div>
                <label for="nome">Nome:</label>
                <input
                    type="text"
                    name="nome"
                    id="nome"
                    value="{{ old('nome', $tipo_despesa->nome) }}"
                    required
                    style="width: 100%; border: 1px solid #d1d5db; border-radius: 4px; padding: 8px;"
                >
            </div>

            <div style="display: flex; justify-content: flex-end;">
                <a href="{{ route('tipo_despesa.index') }}" style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600; text-decoration: none; margin-right: 10px;">
                    Cancelar
                </a>

                <button type="submit" style="background-color: #16a34a; color: white; padding: 8px 16px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">
                    Salvar
                </button>
            </div>
        </form>
    </main>

</body>
</html>