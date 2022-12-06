<?php

use App\Http\Controllers\Api\categoriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('categories/store',[categoriesController::class,'store'])->name('category.store');
Route::get('categories/index',[categoriesController::class,'index'])->name('category.index');
Route::get('categories/show/{id}',[categoriesController::class,'show'])->name('category.show')->middleware('signed');
Route::get('category/show/{id}',[categoriesController::class,'show_category'])->name('show_category');
