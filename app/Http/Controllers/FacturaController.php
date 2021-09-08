<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\ProductoFactura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacturaController extends Controller
{
    
    // Listar facturas
    public function index()
    {
        return Factura::simplePaginate(15);
    }

    // Registrar factura
    public function store(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'id_cliente' => 'required|exists:clientes,id',
        ]);

        if ($validacion->fails()) {
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $factura = new Factura();

        $factura->fecha = date("Y-m-d H:i:s");
        $factura->id_cliente = $request->id_cliente;

        $factura->save();

        return response()->json([
            'message' => 'La factura fue creada',
            'id' => $factura->id
        ], 201);
    }

    // Info factura
    public function show($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json([
                'message' => 'La factura no existe',
            ], 404);
        }

        $cliente = Cliente::find($factura->id_cliente);
        $productos = [];
        $productos_factura = ProductoFactura::where('id_factura','=', $factura->id)->get();

        foreach ($productos_factura as $producto_f) {
            $producto = Producto::find($producto_f->id_inventario);
            $producto['catidad']  = $producto_f->cantidad;
            $producto['id']  = $producto_f->id;
            array_push($productos, $producto);
        }

        $respuesta['data'] = $factura;
        $respuesta['cliente'] = $cliente;
        $respuesta['productos'] = $productos;

        return response()->json($respuesta, 200);
    }

    // Agregar producto a factura
    public function addProduct(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'id_factura' => 'required|exists:facturas,id',
            'id_producto' => 'required|exists:inventario,id',
            'cantidad' => 'required|integer'
        ]);

        if ($validacion->fails()) {
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $cantidad = $request->cantidad;
        $producto_inventario = Producto::find($request->id_producto);

        if($cantidad > $producto_inventario->cantidad)
        {
            return response(['errors' => 'No hay suficientes productos'], 422);
        }

        $producto_inventario->cantidad -= $cantidad;

        $producto_inventario->save();

        $producto = new ProductoFactura();

        $producto->cantidad = $cantidad;
        $producto->id_factura = $request->id_factura;
        $producto->id_inventario = $request->id_producto;

        $producto->save();

        return response()->json([
            'message' => "El producto fue agregado a la factura",
            'id'      => $producto->id
        ], 201);
    }

    // Eliminar factura
    public function destroy($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return response()->json([
                'message' => 'La factura no existe',
            ], 404);
        }

        $factura->delete();

        return response()->json([
            'message' => "La factura $id fue eliminada",
        ], 200);
    }

}
