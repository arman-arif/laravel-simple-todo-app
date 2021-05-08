<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TodoController::class, 'index'])->name('index');
Route::post('/new', [TodoController::class, 'store'])->name('store');
Route::get('/update/{id}', [TodoController::class, 'update'])->name('update');
Route::get('/remove/{id}', [TodoController::class, 'delete'])->name('delete');
