<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EncargoController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Health check
    Route::get('/health', function () {
        return response()->json([
            'status'  => 'ok',
            'app'     => config('app.name'),
            'version' => '1.0.0',
        ]);
    });

    // Auth (Módulo 3)
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login',    [AuthController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/me',      [AuthController::class, 'me']);
        });
    });

    // Productos (Módulo 4)
    Route::prefix('products')->group(function () {
        Route::get('/',            [ProductController::class, 'index']);
        Route::get('/line/{line}', [ProductController::class, 'byLine']);
        Route::get('/{slug}',      [ProductController::class, 'show']);
    });

    // Categorías (Módulo 6)
    Route::get('/categories', [CategoryController::class, 'index']);

    // Webhook Wompi (sin auth — llamado por Wompi directamente)
    Route::post('/webhooks/wompi', [OrderController::class, 'webhook']);

    // Rutas protegidas
    Route::middleware('auth:sanctum')->group(function () {

        // Pedidos (Módulo 8)
        Route::prefix('orders')->group(function () {
            Route::get('/',     [OrderController::class, 'index']);
            Route::post('/',    [OrderController::class, 'store']);
            Route::get('/{id}', [OrderController::class, 'show']);
        });

        // Encargos (Módulo 9)
        Route::prefix('encargos')->group(function () {
            Route::get('/',     [EncargoController::class, 'index']);
            Route::post('/',    [EncargoController::class, 'store']);
            Route::get('/{id}', [EncargoController::class, 'show']);
        });

        // Perfil (Módulo 10)
        Route::prefix('profile')->group(function () {
            Route::put('/',              [ProfileController::class, 'update']);
            Route::put('/password',      [ProfileController::class, 'changePassword']);
        });
    });

});
