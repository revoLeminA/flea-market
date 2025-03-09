<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;


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

Route::get('/home', [ListController::class, 'home']);
Route::get('/', [ListController::class, 'list']);
Route::get('/search', [ListController::class, 'search']);
Route::get('/item/{item_id}', [ItemController::class, 'item']);
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MypageController::class, 'mypage']);
    Route::get('/mypage/profile', [ProfileController::class, 'profile']);
    Route::post('/mypage/profile/upload', [ProfileController::class, 'upload']);
    Route::get('/sell', [SellController::class, 'sell']);
    Route::post('/sell/create', [SellController::class, 'create']);
    Route::post('/item/{item_id}/comment', [ItemController::class, 'comment']);
    Route::post('/item/{item_id}/like/store', [ItemController::class, 'storeLike']);
    Route::post('/item/{item_id}/like/destroy', [ItemController::class, 'destroyLike']);
    // Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'address']);
    // Route::get('/purchase/{item_id}', [PurchaseController::class, 'purchase']);
});

