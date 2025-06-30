<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Contas a Pagar</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    <header style="max-width: 768px; margin: 0 auto 20px;">
        <h1 style="font-size: 1.5rem; font-weight: 600; color: #1f2937;">Contas a Pagar</h1>
    </header>

    <main style="max-width: 768px; margin: 0 auto;">
        <a href="{{ route('contas_pagar.create') }}" style="background-color: #2563eb; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600;">Nova Conta</a>

        <ul style="margin-top: 16px; background: white; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 8px; list-style-type: none;">
            @foreach($contas as $c)
                <li style="padding: 8px 0; border-bottom: 1px solid #e5e7eb;">
                    {{ $c->tipoDespesa->nome }} - R$ {{ number_format($c->valor, 2, ',', '.') }} - {{ \Carbon\Carbon::parse($c->data_vencimento)->format('d/m/Y') }} - Pago: {{ $c->pago ? 'Sim' : 'Não' }}
                </li>
            @endforeach
        </ul>
    </main>

</body>
</html>