<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/categorias', static fn() => view('categoria.index'))->name('categoria.index');
        Route::get('/modelos', static fn() => view('modelo.index'))->name('modelo.index');
        Route::get('/marcas', static fn() => view('marca.index'))->name('marca.index');
        Route::get('/placas', static fn() => view('placa.index'))->name('placa.index');
        Route::get('/vehiculos', static fn() => view('vehiculo.index'))->name('vehiculo.index');
        Route::get('/usuarios', static fn() => view('usuario.index'))->name('usuario.index');
    });

    Route::get('/tarjetas', static fn() => view('tarjeta.index'))->name('tarjeta.index');
    Route::get('/alquilar', static fn() => view('alquiler.index'))->name('alquiler.index');
});
