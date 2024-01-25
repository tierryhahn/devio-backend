<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KitchenOrderController;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

Route::post('/orders/{orderId}/items', [OrderItemController::class, 'addItem']);
Route::delete('/orders/{orderId}/items/{itemId}', [OrderItemController::class, 'removeItem']);

Route::post('/orders/{orderId}/payments', [PaymentController::class, 'addPayment']);
Route::delete('/orders/{orderId}/payments/{paymentId}', [PaymentController::class, 'removePayment']);

Route::get('/kitchen-orders', [KitchenOrderController::class, 'index']);
Route::put('/kitchen-orders/{id}/complete', [KitchenOrderController::class, 'markAsComplete']);
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
