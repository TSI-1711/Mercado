@extends('template')

@section('conteudo')
<div class="container py-4">
    <h2>Contas Recebidas (Pagas)</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
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
                <td><span class="badge bg-success">Recebido</span></td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Nenhuma conta recebida encontrada.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
