<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Nivel_acessoController;
use App\Http\Controllers\ContaReceberController;
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

//Route::get('/nivel_acesso', [Nivel_acessoController::class, 'listar']);
