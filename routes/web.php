<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TranspilerController;
use App\Http\Controllers\ExplainerController;
use App\Http\Controllers\DitaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/category', [CategoryController::class, 'index']);
Route::get('/transpiler', [TranspilerController::class, 'index']);
Route::get('/explainer', [ExplainerController::class, 'index']);
Route::get('/dita', [DitaController::class, 'index']);
