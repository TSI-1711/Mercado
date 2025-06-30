<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Compras</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    <header style="max-width: 768px; margin: 0 auto 20px;">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #1f2937;">Compras</h1>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">
        <a href="{{ route('compra.create') }}" style="background-color: #2563eb; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600;">Nova Compra</a>

        <ul style="margin-top: 16px; background: white; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 8px; list-style-type: none;">
            @foreach($compras as $compra)
                <li style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                    {{ $compra->fornecedor->nome }} - {{ \Carbon\Carbon::parse($compra->data)->format('d/m/Y') }}
                </li>
            @endforeach
        </ul>
    </main>

</body>
</html>