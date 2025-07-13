{{-- filepath: resources/views/contas_receber/pagamento.blade.php --}}
@extends('template')

@section('conteudo')
<div class="container py-4">
    <h2>Pagamento da Conta #{{ $conta->id }}</h2>
    <div class="card p-4">
        <div class="alert alert-warning text-center">
            Você tem <span id="timer" class="fw-bold">30</span> segundos para realizar o pagamento.
        </div>
        <p><strong>Cliente:</strong> {{ $conta->cliente->nome ?? $conta->cliente_id }}</p>
        <p><strong>Valor:</strong> R$ {{ number_format($conta->valor, 2, ',', '.') }}</p>
        <p><strong>Vencimento:</strong> {{ \Carbon\Carbon::parse($conta->data_vencimento)->format('d/m/Y') }}</p>
        <form action="{{ route('contas-receber.confirmar-pagamento', $conta->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Simular Pagamento</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tempoLimite = 30; // 30 segundos
    const contaId = {{ $conta->id }};
    const urlMarcarVencida = "{{ route('contas-receber.marcar-vencida', $conta->id) }}";
    const urlVencidas = "{{ route('contas-receber.vencidas') }}";
    const formPagamento = document.querySelector('form');
    const timerElement = document.getElementById('timer');

    let tempoRestante = tempoLimite;
    let intervalId;
    let timeoutId;

    function atualizarTimer() {
        timerElement.textContent = tempoRestante;
        if (tempoRestante <= 0) {
            clearInterval(intervalId);
        }
        tempoRestante--;
    }

    function iniciarTimeout() {
        // Inicia o contador visual
        intervalId = setInterval(atualizarTimer, 1000);

        // Define o timeout para marcar como vencida
        timeoutId = setTimeout(() => {
            fetch(urlMarcarVencida, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = urlVencidas + '?timeout=1';
                }
            })
            .catch(error => {
                console.error('Erro ao marcar a conta como vencida:', error);
            });
        }, tempoLimite * 1000);
    }

    function pararTimeout() {
        clearInterval(intervalId);
        clearTimeout(timeoutId);
    }

    // Inicia o timeout quando a página carrega
    iniciarTimeout();
    atualizarTimer(); // Chama uma vez para exibir o tempo inicial

    // Para o timeout se o formulário for submetido (pagamento realizado)
    formPagamento.addEventListener('submit', pararTimeout);
});
</script>
@endpush
