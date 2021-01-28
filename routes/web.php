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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\VeiculosController::class, 'index']);
    Route::get('/veiculos', [\App\Http\Controllers\VeiculosController::class, 'index'])->name('veiculos-index');
    Route::get('/veiculos/formulario', [\App\Http\Controllers\VeiculosController::class, 'criar'])->name('veiculos-criar');
    Route::post('/veiculos', [\App\Http\Controllers\VeiculosController::class, 'salvar'])->name('veiculos-salvar');
    Route::put('/veiculos/{id}', [\App\Http\Controllers\VeiculosController::class, 'atualizar'])->name('veiculos-atualizar');
    Route::get('/veiculos/{id}', [\App\Http\Controllers\VeiculosController::class, 'editar'])->name('veiculos-editar');
    Route::delete('/veiculos/{id}', [\App\Http\Controllers\VeiculosController::class, 'deletar'])->name('veiculos-deletar');
    Route::get('/relatorio', [\App\Http\Controllers\VeiculosController::class, 'relatorioVeiculo'])->name('veiculos-relatorio');

    Route::get('/reservas', [\App\Http\Controllers\VeiculosReservasController::class, 'index'])->name('reservas-index');
    Route::get('/reservas/formulario', [\App\Http\Controllers\VeiculosReservasController::class, 'criar'])->name('reservas-criar');
    Route::post('/reservas', [\App\Http\Controllers\VeiculosReservasController::class, 'salvar'])->name('reservas-salvar');
    Route::put('/reservas/{id}', [\App\Http\Controllers\VeiculosReservasController::class, 'atualizar'])->name('reservas-atualizar');
    Route::get('/reservas/{id}', [\App\Http\Controllers\VeiculosReservasController::class, 'editar'])->name('reservas-editar');
    Route::delete('/reservas/{id}', [\App\Http\Controllers\VeiculosReservasController::class, 'deletar'])->name('reservas-deletar');

    Route::get('/usuarios', [\App\Http\Controllers\UsuariosController::class, 'index'])->name('usuarios-index');
    Route::get('/usuarios/formulario', [\App\Http\Controllers\UsuariosController::class, 'criar'])->name('usuarios-criar');
    Route::post('/usuarios', [\App\Http\Controllers\UsuariosController::class, 'salvar'])->name('usuarios-salvar');
    Route::put('/usuarios/{id}', [\App\Http\Controllers\UsuariosController::class, 'atualizar'])->name('usuarios-atualizar');
    Route::get('/usuarios/{id}', [\App\Http\Controllers\UsuariosController::class, 'editar'])->name('usuarios-editar');
    Route::delete('/usuarios/{id}', [\App\Http\Controllers\UsuariosController::class, 'deletar'])->name('usuarios-deletar');
});



//Route::get('/usuarios', [\App\Http\Controllers\UsuariosController::class, 'index'])->middleware(['auth'])->name('usuarios-index');


require __DIR__.'/auth.php';
