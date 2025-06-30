<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Nivel_acessoController;
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

Route::get('/', function () {
    return view('home');
});

//Route::get('/nivel_acesso', [Nivel_acessoController::class, 'listar']);
Route::resource('fornecedor', FornecedorController::class);
Route::resource('compra', CompraController::class);
Route::resource('contas_pagar', ContasPagarController::class);
Route::resource('tipo_despesa', TipoDespesaController::class);