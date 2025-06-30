<h1>Contas Vencidas</h1>
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
    </tr>
    @endforeach
</table>
