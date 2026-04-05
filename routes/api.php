<?php

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
    // Productos (Módulo 4)
    // Pedidos (Módulo 8)
    // Encargos (Módulo 9)
    // Perfil (Módulo 10)

});
