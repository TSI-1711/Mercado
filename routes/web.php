<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Nivel_acessoController;
use App\Http\Controllers\ContaReceberController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ContasPagarController;
use App\Http\Controllers\TipoDespesaController;

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
route::get('/contas_receber', [ContaReceberController::class, 'index']);
route::patch('contas-receber/{id}/baixa', [ContaReceberController::class, 'baixa'])->name('contas-receber.baixa');
Route::get('contas-receber-vencidas', [ContaReceberController::class, 'vencidas'])->name('contas-receber.vencidas');
//



//Route::get('/nivel_acesso', [Nivel_acessoController::class, 'listar']);
Route::resource('fornecedor', FornecedorController::class);
Route::resource('compra', CompraController::class);
Route::resource('contas_pagar', ContasPagarController::class);
Route::resource('tipo_despesa', TipoDespesaController::class);

Route::get('/', function () {
    return view('home');
});



//Route::get('/nivel_acesso', [Nivel_acessoController::class, 'listar']);