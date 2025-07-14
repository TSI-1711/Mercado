<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Nivel_acessoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\OcorrenciasController;
use App\Http\Controllers\FolhaPagamentoController;
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

// Rotas para Funcionários
Route::resource('funcionarios', FuncionarioController::class);

// Rotas para Ocorrências
Route::resource('ocorrencias', OcorrenciasController::class);

// Rotas para Folha de Pagamento
Route::post('folhaPagamento/gerar', [FolhaPagamentoController::class, 'gerarFolha'])->name('folhaPagamento.gerar');
Route::resource('folhaPagamento', FolhaPagamentoController::class);