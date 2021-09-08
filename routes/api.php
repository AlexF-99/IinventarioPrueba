<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ProductoController;
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

// Crear producto
// POST url: 127.0.0.1:8000/api/productos/

// Listar Productos
// GET url: 127.0.0.1:8000/api/productos/

// Ver un producto
// GET url: 127.0.0.1:8000/api/productos/{id}

// Actualizar un producto
// PUT url: 127.0.0.1:8000/api/productos/{id}

// borrar un producto
// DELETE url: 127.0.0.1:8000/api/productos/{id}

Route::apiResource('productos', ProductoController::class);

// Crear cliente
// POST url: 127.0.0.1:8000/api/clientes/
Route::post('clientes',[ClienteController::class, 'store']);
// lista de clientes
// GET url: 127.0.0.1:8000/api/clientes/
Route::get('clientes', [ClienteController::class, 'index']);
// eliminar cliente
// DELETE url: 127.0.0.1:8000/api/clientes/{id}
Route::delete('clientes/{id}', [ClienteController::class, 'destroy']);

// Crear factura
// POST url: 127.0.0.1:8000/api/facturas/
Route::post('facturas', [FacturaController::class, 'store']);
// Agregar producto a factura
// POST url: 127.0.0.1:8000/api/facturas/producto
Route::post('facturas/producto', [FacturaController::class, 'addProduct']);
// lista de facturas
// GET url: 127.0.0.1:8000/api/facturas/
Route::get('facturas', [FacturaController::class, 'index']);
// ver factura - Muestra productos de factura
// GET url: 127.0.0.1:8000/api/facturas/{id}
Route::get('facturas/{id}', [FacturaController::class, 'show']);
// eliminar factura
// DELETE url: 127.0.0.1:8000/api/facturas/{id}
Route::delete('facturas/{id}', [FacturaController::class, 'destroy']);


