<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Compras;
use App\Http\Controllers\MercadoPago;
use App\Http\Controllers\Products;
use App\Http\Controllers\Users;
use App\Http\Controllers\Categories;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API

// == Compras ==
Route::get('compras',[Compras::class, 'getAll']);
Route::post('compras',[Compras::class, 'add']);
Route::put('compras',[Compras::class, 'update']);
Route::get('compras/{id}',[Compras::class, 'getOne']);

// == Products ==
Route::get('products',[Products::class, 'getAll']);
Route::post('products',[Products::class, 'add']);
Route::post('products/addImage',[Products::class, 'addImage']);
Route::delete('products/{id}',[Products::class, 'delete']);
Route::get('products/search/{value}',[Products::class, 'search']);
Route::get('products/agotados',[Products::class, 'agotados']);
Route::get('products/categorie/{id}',[Products::class, 'productById']);
Route::get('products/news',[Products::class, 'news']);

// == Categories ==
Route::get('categories',[Categories::class, 'principal']);
Route::get('categories/all',[Categories::class, 'getAll']);
Route::get('categories/sub/{id}',[Categories::class, 'subCategories']);
Route::post('categories',[Categories::class, 'add']);
Route::delete('categories/{id}',[Categories::class, 'delete']);


// Stats
Route::get('getAllUserThisMonth',[Users::class, 'getAllThisMonth']);
Route::post('getAllUserThisMonth',[Users::class, 'add']);

Route::get('getAllSalesThisMonth',[Compras::class, 'getAllThisMonth']);
Route::get('generateYearChart',[Compras::class, 'generateYearChart']);


// MercadoPago
Route::post('createPreference',[MercadoPago::class, 'createPreference']);
Route::post('notification',[MercadoPago::class, 'notificationIPN']);



/* TODO
    - Nuevos productos
    - Mas vendidos
    - Mejorar compra y carro
    - Me gusta (GET, POST, DELETE)
    -
*/
