{{-- filepath: resources/views/contas_receber/contasVencidas.blade.php --}}
@extends('template')

@section('conteudo')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-danger">Contas Vencidas</h2>
        <a href="{{ route('contas-receber.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-danger">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Vencimento</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        @forelse($contas as $conta)
            <tr>
                <td>{{ $conta->id }}</td>
                <td>{{ $conta->cliente->nome ?? $conta->cliente_id }}</td>
                <td>R$ {{ number_format($conta->valor, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($conta->data_vencimento)->format('d/m/Y') }}</td>
                <td>
                    <span class="badge bg-danger">Vencido</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Nenhuma conta vencida encontrada.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
