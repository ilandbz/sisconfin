<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistroCuentaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('login', function () {
    return view('login');
})->name('login');


Route::group(['prefix' => 'usuarios', 'middleware' => 'auth'], function () {
    Route::get('/', [UsuarioController::class, 'index']);
    Route::post('/', [UsuarioController::class, 'store']);
    Route::get('/todos', [UsuarioController::class, 'lista']);
    Route::post('/eliminar', [UsuarioController::class, 'destroy']);
    Route::get('/obtener', [UsuarioController::class, 'obtenerusuario']);
    Route::post('/resetear', [UsuarioController::class, 'resetearusuario']);
    Route::get('/cambiar-estado', [UsuarioController::class, 'cambiarestado']);
    Route::get('/perfil', [UsuarioController::class, 'perfil']);
    Route::post('/cambiarclave', [UsuarioController::class, 'cambiarclave']);
});




Route::get('registro-create', [RegistroCuentaController::class, 'index'])->middleware('auth');
Route::post('cuenta', [RegistroCuentaController::class, 'store']);

Route::post('login', [LoginController::class, 'autenticar'])->name('acceder');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/', [HomeController::class, 'index'])->middleware('auth');