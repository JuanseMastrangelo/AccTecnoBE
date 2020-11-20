<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/compras', [App\Http\Controllers\Compras::class, 'index'])->name('getAllCompras');
Route::get('/cargar/productos', function () { return view('carga.productos'); })->name('cargarProductos');
Route::get('/estadisticas', function () { return view('estadisticas.main.stats-main'); })->name('estadisticas');


Route::get('/cargar/categorias', [App\Http\Controllers\Categories::class, 'index'])->name('categorias');


