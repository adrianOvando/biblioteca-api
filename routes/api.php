<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrestamoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(JwtMiddleware::class)->apiResource('libros', LibroController::class);

Route::post('/login', [LoginController::class, 'login']);
    
Route::middleware(JwtMiddleware::class)->group(function () {
    
    // Resulta que asi ya se hace un crud osea pones prestamo con un metodo digamos get y te mestrra todos los prestamos
    // si quieres borrar solo pones prestamo/{id} y lo borra y lo mismo con el resto
    // get ver
    // post crear
    // put actualizar
    // delete eliminar y eso en el postman sin necesida de poner una ruta para cada uno
    Route::apiResource('prestamos', PrestamoController::class);
    
    Route::get('misprestamos', [PrestamoController::class, 'misPrestamos']);

});



    