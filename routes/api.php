<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/veiculos', [\App\Http\Controllers\Api\VeiculosController::class, 'listar']);
Route::delete('/veiculos/{id}', [\App\Http\Controllers\Api\VeiculosController::class, 'deletar']);
Route::get('/veiculos-disponiveis/{inicio}/{fim}', [\App\Http\Controllers\Api\VeiculosController::class, 'listarDisponiveis']);
Route::get('/relatorio/{veiculo}/{mes}', [\App\Http\Controllers\Api\VeiculosController::class, 'relatorioVeiculo']);

Route::get('/reservas', [\App\Http\Controllers\Api\VeiculosReservasController::class, 'listar']);
Route::post('/reservas', [\App\Http\Controllers\Api\VeiculosReservasController::class, 'salvar']);
Route::put('/reservas/{id}', [\App\Http\Controllers\Api\VeiculosReservasController::class, 'atualizar']);
Route::delete('/reservas/{id}', [\App\Http\Controllers\Api\VeiculosReservasController::class, 'deletar']);

Route::get('/usuarios', [\App\Http\Controllers\Api\UsuariosController::class, 'listar']);
Route::delete('/usuarios/{id}', [\App\Http\Controllers\Api\UsuariosController::class, 'deletar']);
