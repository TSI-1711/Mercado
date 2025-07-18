<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Nivel_acessoController;
use App\Http\Controllers\ContaReceberController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ContasPagarController;
use App\Http\Controllers\TipoDespesaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\EntradaController;

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

// Rotas para o módulo de compras
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
});

// Rotas para o gerenciamento de contas a receber
route::get('/contas_receber', [ContaReceberController::class, 'index']);
route::patch('contas-receber/{id}/baixa', [ContaReceberController::class, 'baixa'])->name('contas-receber.baixa');
Route::get('contas-receber-vencidas', [ContaReceberController::class, 'vencidas'])->name('contas-receber.vencidas');

// Rotas do módulo de compras
Route::resource('produtos', ProdutoController::class);
Route::resource('orcamentos', OrcamentoController::class);
Route::resource('compras', CompraController::class);
Route::resource('entradas', EntradaController::class);

// Rota para buscar itens de uma compra (AJAX)
Route::get('compras/{compra}/itens', [CompraController::class, 'getItens'])->name('compras.itens');

// Rotas existentes
Route::resource('fornecedor', FornecedorController::class);
Route::resource('compra', CompraController::class);
Route::resource('contas_pagar', ContasPagarController::class);
Route::resource('tipo_despesa', TipoDespesaController::class);

Route::get('/', function () {
    return view('home');
});