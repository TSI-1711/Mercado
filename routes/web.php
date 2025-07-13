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

// Rotas para o gerenciamento de contas a receber
Route::get('/contas-receber', [ContaReceberController::class, 'index']);
Route::patch('contas-receber/{id}/baixa', [ContaReceberController::class, 'baixa'])->name('contas-receber.baixa');
Route::get('contas-receber', [ContaReceberController::class, 'vencidas'])->name('contas-receber.contasVencidas');
//


Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::resource('produtos', ProdutoController::class);
});
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
});


Route::resource('fornecedor', FornecedorController::class);
Route::resource('compra', CompraController::class);
Route::resource('contas_pagar', ContasPagarController::class);
Route::resource('tipo_despesa', TipoDespesaController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('vendas', VendaController::class)->except(['edit', 'update']);

Route::get('/contas_receber', [ContaReceberController::class, 'index']);
Route::patch('contas-receber/{id}/baixa', [ContaReceberController::class, 'baixa'])->name('contas-receber.baixa');
Route::get('contas-receber-vencidas', [ContaReceberController::class, 'vencidas'])->name('contas-receber.vencidas');
Route::post('vendas/{venda}/gerar-pagamento', [VendaController::class, 'gerarPagamento'])->name('vendas.gerar-pagamento');
