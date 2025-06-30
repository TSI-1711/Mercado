{{-- filepath: resources/views/contas_receber/index.blade.php --}}
<h1>Contas a Receber</h1>
<a href="{{ route('contas-receber.create') }}">Nova Conta</a>
<table>
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Valor</th>
        <th>Vencimento</th>
        <th>Status</th>
    </tr>
    @foreach($contas as $conta)
    <tr>
        <td>{{ $conta->id }}</td>
        <td>{{ $conta->cliente_id }}</td>
        <td>{{ $conta->valor }}</td>
        <td>{{ $conta->data_vencimento }}</td>
        <td>{{ $conta->status }}</td>
        <td>
              @if($conta->status !== 'recebido')
        <form action="{{ route('contas-receber.baixa', $conta->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit">Baixar</button>
        </form>
        @endif
        </td>

    </tr>
    @endforeach
</table>
