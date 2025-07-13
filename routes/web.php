<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Nivel_acessoController;
use App\Http\Controllers\ContaReceberController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ContasPagarController;
use App\Http\Controllers\TipoDespesaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ProductController;
use PgSql\Result;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//


Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::resource('produtos', ProdutoController::class);
});


Route::resource('fornecedor', FornecedorController::class);
Route::resource('compra', CompraController::class);
Route::resource('contas_pagar', ContasPagarController::class);
Route::resource('tipo_despesa', TipoDespesaController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('vendas', VendaController::class)->except(['edit', 'update']);

Route::post('vendas/{venda}/gerar-pagamento', [VendaController::class, 'gerarPagamento'])->name('vendas.gerar-pagamento');

Route::prefix('contas-receber')->name('contas-receber.')->group(function () {
    Route::get('/recebidas', [ContaReceberController::class, 'recebidas'])->name('recebidas');
    Route::get('/vencidas', [ContaReceberController::class, 'vencidas'])->name('vencidas');
    Route::get('/{id}/pagar', [ContaReceberController::class, 'pagamento'])->name('pagamento');
    Route::post('/{id}/pagar', [ContaReceberController::class, 'confirmarPagamento'])->name('confirmar-pagamento');
    Route::post('/{id}/marcar-vencida', [ContaReceberController::class, 'marcarComoVencida'])->name('marcar-vencida');
});
