<?php

use App\Http\Controllers\API\SalesController;
use App\Http\Controllers\API\OrdersController;
use App\Http\Controllers\API\StocksController;
use App\Http\Controllers\API\IncomesController;
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

Route::middleware('auth.token')->group(function () {
    Route::get('/sales', [SalesController::class, 'list']);
    Route::get('/orders', [OrdersController::class, 'list']);
    Route::get('/stocks', [StocksController::class, 'list']);
    Route::get('/incomes', [IncomesController::class, 'list']);
});


