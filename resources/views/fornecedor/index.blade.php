<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Fornecedores</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    <header style="max-width: 768px; margin: 0 auto 20px;">
        <h2 style="font-weight: 600; font-size: 1.25rem; color: #1f2937;">Lista de Fornecedores</h2>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">
        <a href="{{ route('fornecedor.create') }}" style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600;">
            Novo Fornecedor
        </a>

        <div style="margin-top: 16px; background: white; padding: 16px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
            <ul style="list-style: none; padding-left: 0;">
                @foreach($fornecedores as $fornecedor)
                    <li style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                        {{ $fornecedor->nome }} - {{ $fornecedor->cnpj }}
                    </li>
                @endforeach
            </ul>
        </div>
    </main>

</body>
</html>