<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoAjaxController;

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

Route::group(['prefix' => 'index', 'as' => 'ajax.'], function () {
    Route::get('/', [TodoAjaxController::class, 'index'])->name('index');
    Route::get('/list', [TodoAjaxController::class, 'list'])->name('list');
    Route::post('/new', [TodoAjaxController::class, 'store'])->name('store');
    Route::get('/update/{id}', [TodoAjaxController::class, 'update'])->name('update');
    Route::get('/remove/{id}', [TodoAjaxController::class, 'delete'])->name('delete');
});
