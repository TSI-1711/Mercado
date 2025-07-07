<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Contas a Pagar</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    <div style="max-width: 1200px; margin: 0 auto;">
        <header style="margin-bottom: 20px;">
            <h1 style="font-weight: 600; font-size: 1.5rem; color: #1f2937;">Contas a Pagar</h1>
        </header>

        <a href="{{ route('contas_pagar.create') }}" style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; display: inline-block; margin-bottom: 20px;">
            Nova Conta a Pagar
        </a>

        <div style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f9fafb; text-align: left;">
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Tipo</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Valor</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Vencimento</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Status</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Compra</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contas as $conta)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px 16px;">{{ $conta->tipoDespesa->nome }}</td>
                            <td style="padding: 12px 16px;">R$ {{ number_format($conta->valor, 2, ',', '.') }}</td>
                            <td style="padding: 12px 16px;">{{ \Carbon\Carbon::parse($conta->data_vencimento)->format('d/m/Y') }}</td>
                            <td style="padding: 12px 16px;">
                                <span style="background-color: {{ $conta->pago ? '#10b981' : '#ef4444' }}; color: white; padding: 4px 8px; border-radius: 12px; font-size: 0.75rem;">
                                    {{ $conta->pago ? 'Pago' : 'Pendente' }}
                                </span>
                            </td>
                            <td style="padding: 12px 16px;">
                                {{ $conta->compra_id ? 'Compra #'.$conta->compra_id : '-' }}
                            </td>
                            <td style="padding: 12px 16px;">
                                <a href="{{ route('contas_pagar.edit', $conta->id) }}" style="background-color: #f59e0b; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-weight: 600; font-size: 0.875rem; display: inline-block; margin-right: 8px;">Editar</a>

                                <form action="{{ route('contas_pagar.destroy', $conta->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Confirma exclusão desta conta?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #ef4444; color: white; padding: 6px 12px; border-radius: 4px; border: none; font-weight: 600; font-size: 0.875rem; cursor: pointer;">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 12px 16px; text-align: center;">Nenhuma conta a pagar cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>