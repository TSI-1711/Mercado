@extends('template')

@section('conteudo')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Contas a Receber</h2>
        <a href="{{ route('contas-receber.create') }}" class="btn btn-primary">Nova Conta</a>
    </div>
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
        @foreach($contas as $conta)
            <tr>
                <td>{{ $conta->id }}</td>
                <td>{{ $conta->cliente->nome ?? $conta->cliente_id }}</td>
                <td>R$ {{ number_format($conta->valor, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($conta->data_vencimento)->format('d/m/Y') }}</td>
                <td>
                    @if($conta->status === 'recebido')
                        <span class="badge bg-success">Recebido</span>
                    @elseif($conta->data_vencimento < now()->toDateString())
                        <span class="badge bg-danger">Vencido</span>
                    @else
                        <span class="badge bg-secondary">Aberto</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
