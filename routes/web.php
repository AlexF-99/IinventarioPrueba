<?php
use App\Http\Controllers\GuiController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});
*/

///-----------------------------
///------- INTERFAZ GRAFICA ----------
//--------------------------------

Route::get('/', [GuiController::class, 'inicio']);
Route::get('/soy-proveedor', [GuiController::class, 'soyProveedor']);
Route::get('/soy-cliente', [GuiController::class, 'soyCliente']);
Route::get('/listado-inventario', [GuiController::class, 'listadoInventario']);
Route::get('/listado-facturas', [GuiController::class, 'listadoFacturas']);
