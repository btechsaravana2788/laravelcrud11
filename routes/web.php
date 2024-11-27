<?php

use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\ProductController;
  
Route::get('/', function () {
    return view('welcome');
});

//Route::get('products/import', 'ProductController@imports')->name('products.import');
Route::get('products/import', [ProductController::class,'imports'])->name('products.import'); 

Route::post('products/importstore', [ProductController::class,'importstore'])->name('products.importstore');

Route::get('products/export', [ProductController::class,'export'])->name('products.export');
 
Route::resource('products', ProductController::class);