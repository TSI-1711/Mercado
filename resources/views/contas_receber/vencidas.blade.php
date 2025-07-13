@extends('template')

@section('conteudo')
<div class="container py-4">
    <h2>Contas Vencidas (Não Pagas)</h2>
    @if(request()->get('timeout'))
        <div class="alert alert-danger">
            O tempo para pagamento expirou e a conta foi marcada como vencida.
        </div>
    @endif
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-danger">
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Vencimento</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
        @forelse($contas as $conta)
            <tr>
                <td>{{ $conta->id }}</td>
                <td>{{ $conta->cliente->nome ?? $conta->cliente_id }}</td>
                <td>R$ {{ number_format($conta->valor, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($conta->data_vencimento)->format('d/m/Y') }}</td>
                <td><span class="badge bg-danger">Vencido</span></td>
                <td>
                    <a href="{{ route('contas-receber.pagamento', $conta->id) }}" class="btn btn-primary btn-sm">Gerar Pagamento</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Nenhuma conta vencida encontrada.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
