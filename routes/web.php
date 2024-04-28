<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;

Route::get('/', function () {
    return view('dashboard.list');
})->name('/');

// product category
Route::get('product_category/list',[ProductCategoryController::class,'list_'])->name('product_category.list');
Route::post('product_category/edit/{id}',[ProductCategoryController::class,'edit'])->name('product_category.edit');
Route::get('product_category/edit/{id}/{argument?}',[ProductCategoryController::class,'edit'])->name('product_category.edit');
Route::get('product_category/delete/{id}',[ProductCategoryController::class,'delete'])->name('product_category.delete');
// product
Route::get('product/list',[ProductController::class,'list_'])->name('product.list');
Route::post('product/edit/{id}',[ProductController::class,'edit'])->name('product.edit');
Route::get('product/edit/{id}/{argument?}/{productCategoryId?}',[ProductController::class,'edit'])->name('product.edit');
Route::get('product/delete/{id}',[ProductController::class,'delete'])->name('product.delete');
