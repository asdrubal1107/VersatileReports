<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    // Rutas de autenticacion
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Rutas de restablecer contraseña
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/principal', function () {
        return view('dashboard');
    })->name('principal');

    Route::middleware(['Administrador'])->group(function () {
        //rutas usuarios
        Route::get('/usuarios', [UsuarioController::class, 'mostrar_vista_usuarios']);
        Route::get('/usuarios/listar', [UsuarioController::class, 'index']);
        Route::get('/usuarios/actualizar/{id}', [UsuarioController::class, 'mostrar_vista_editar_usuarios']);
    });

    Route::middleware(['Contratista'])->group(function () {

    });
});

