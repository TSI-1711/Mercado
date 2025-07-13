<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Tipos de Despesa</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body style="font-family: sans-serif; background-color: #f3f4f6; padding: 20px;">

    @extends('template')

    <div style="max-width: 1200px; margin: 0 auto;">
        <header style="margin-bottom: 20px; margin-top: 60px;">
            <h1 style="font-weight: 600; font-size: 1.5rem; color: #1f2937;">Lista de Tipos de Despesa</h1>
        </header>

        <a href="{{ route('tipo_despesa.create') }}" style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; display: inline-block; margin-bottom: 20px;">
            Novo Tipo de Despesa
        </a>

        <div style="background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f9fafb; text-align: left;">
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; font-weight: 600;">ID</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Nome</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Criado em</th>
                        <th style="padding: 12px 16px; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tipos as $tipo)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px 16px;">{{ $tipo->id }}</td>
                            <td style="padding: 12px 16px;">{{ $tipo->nome }}</td>
                            <td style="padding: 12px 16px;">{{ $tipo->created_at->format('d/m/Y') }}</td>
                            <td style="padding: 12px 16px;">
                                <a href="{{ route('tipo_despesa.edit', $tipo->id) }}" style="background-color: #f59e0b; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-weight: 600; font-size: 0.875rem; display: inline-block; margin-right: 8px;">Editar</a>

                                <form action="{{ route('tipo_despesa.destroy', $tipo->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Confirma exclusão deste tipo de despesa?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: #ef4444; color: white; padding: 6px 12px; border-radius: 4px; border: none; font-weight: 600; font-size: 0.875rem; cursor: pointer;">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="padding: 12px 16px; text-align: center;">Nenhum tipo de despesa cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>