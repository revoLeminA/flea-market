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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('auth')->group(function () {
    Route::get('/home', [ListController::class, 'home']);
    Route::get('/', [ListController::class, 'list']);
    Route::get('/mypage', [MypageController::class, 'mypage']);
    Route::get('/mypage/profile', [ProfileController::class, 'profile']);
    Route::post('/mypage/profile/upload', [ProfileController::class, 'upload']);
    Route::get('/sell', [SellController::class, 'sell']);
    Route::post('/sell/create', [SellController::class, 'create']);
    Route::get('/item/{item_id}', [ItemController::class, 'item']);
    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'address']);
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'purchase']);
});

