<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('app');
// });

// Route::get('login', function(){
//     return view('login');
// })->name('login');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios');

Route::post('usuarios', [UsuarioController::class, 'store'])->name('guardarusuario');

Route::post('login', [LoginController::class, 'autenticar'])->name('acceder');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('app');
})->middleware('auth');