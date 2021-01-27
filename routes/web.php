<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/veiculos', [\App\Http\Controllers\VeiculosController::class, 'index'])->name('veiculos-index');
Route::get('/veiculos/formulario', [\App\Http\Controllers\VeiculosController::class, 'criar'])->name('veiculos-criar');
Route::post('/veiculos', [\App\Http\Controllers\VeiculosController::class, 'salvar'])->name('veiculos-salvar');
Route::put('/veiculos/{id}', [\App\Http\Controllers\VeiculosController::class, 'atualizar'])->name('veiculos-atualizar');
Route::get('/veiculos/{id}', [\App\Http\Controllers\VeiculosController::class, 'editar'])->name('veiculos-editar');
Route::delete('/veiculos/{id}', [\App\Http\Controllers\VeiculosController::class, 'deletar'])->name('veiculos-deletar');

Route::get('/usuarios', [\App\Http\Controllers\UsuariosController::class, 'index'])->middleware(['auth'])->name('usuarios-index');


require __DIR__.'/auth.php';
