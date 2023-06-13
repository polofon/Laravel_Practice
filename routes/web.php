<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
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

Route::get('/', [ListController::class, 'index']);

Route::get('/searchItemRoute', [ListController::class, 'searchItem'])->name('searchItem');

Route::post('/saveItemRoute', [ListController::class, 'saveItem'])->name('saveItem');

Route::post('/markCompleteRoute/{id}', [ListController::class, 'markComplete'])->name('markComplete');

Route::post('/deleteItemRoute/{id}', [ListController::class, 'deleteItem'])->name('deleteItem');

Route::post('findItemRoute/{name}', [ListController::class, 'findItem'])->name('findItem');

Route::post('totalItemRoute/{id}', [ListController::class, 'totalItem'])->name('totalItem');