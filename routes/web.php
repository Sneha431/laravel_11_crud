<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::get("/products", [ProductController::class, 'index'])->name("products.index");
// Route::get("/products/create", [ProductController::class, 'create'])->name("products.create");
// Route::post("/products", [ProductController::class, 'store'])->name("products.store");
// Route::get("/products/{productid}/edit", [ProductController::class, 'edit'])->name("products.edit");
// Route::put("/products/{productid}", [ProductController::class, 'update'])->name("products.update");
// Route::delete("/products/{productid}", [ProductController::class, 'destroy'])->name("products.destroy");

Route::controller(ProductController::class)->group(function () {
    Route::get("/products", 'index')->name("products.index");
    Route::get("/products/create", 'create')->name("products.create");
    Route::post("/products", 'store')->name("products.store");
    Route::get("/products/{productid}/edit", 'edit')->name("products.edit");
    Route::put("/products/{productid}", 'update')->name("products.update");
    Route::delete("/products/{productid}", 'destroy')->name("products.destroy");
});