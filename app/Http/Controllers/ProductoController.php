<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{

    // Listar productos
    public function index()
    {
        return Producto::simplePaginate(15);
    }

    // Guardar los productos
    public function store(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'nombre_producto' => 'required|string|max:45',
            'lote' => 'required|string|max:20',
            'cantidad' => 'required|integer',
            'vencimiento' => 'required|date',
            'precio' => 'required|numeric',
        ]);

        if ($validacion->fails()) {
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $producto = new Producto();

        $producto->nombre_producto = $request->nombre_producto;
        $producto->lote = $request->lote;
        $producto->cantidad = $request->cantidad;
        $producto->vencimiento = $request->vencimiento;
        $producto->precio_unidad = $request->precio;

        $producto->save();

        return response()->json([
            'message' => "El producto '$request->nombre_producto' fue registrado con exito",
        ], 201);
    }

    // mostrar un producto
    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'El producto no existe',
            ], 404);
        }

        return $producto;
    }

    // actualizar producto
    public function update(Request $request, $id)
    {
        $validacion = Validator::make($request->all(), [
            'nombre_producto' => 'string|max:45',
            'vencimiento' => 'date',
        ]);

        if ($validacion->fails()) {
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'El producto no existe',
            ], 404);
        }

        if ($request->nombre_producto) {
            $producto->nombre_producto = $request->nombre_producto;
        }

        if ($request->vencimiento) {
            $producto->vencimiento = $request->vencimiento;
        }

        $producto->save();

        return response()->json([
            'message' => "El producto $producto->nombre_producto fue actualizado",
        ], 200);

    }

    // Eliminar producto
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json([
                'message' => 'El producto no existe',
            ], 404);
        }

        $nombre_producto = $producto->nombre;
        $producto->delete();

        return response()->json([
            'message' => "El producto $nombre_producto fue eliminado",
        ], 200);
    }

}
