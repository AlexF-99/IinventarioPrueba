<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    
    // lista de clientes
    public function index()
    {
        return Cliente::simplePaginate(15);
    }

    // Crear cliente
    public function store(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'tipo_documento' => 'required|string|max:10',
            'num_documento' => 'required|integer',
            'nombre' => 'required|string|max:100',
            'telefono' => 'intenger',
            'direccion' => 'string|max:45',
        ]);

        if ($validacion->fails()) {
            return response(['errors' => $validacion->errors()->all()], 422);
        }

        $cliente = Cliente::where('tipo_documento', '=', $request->tipo_documento)
                    ->where('num_documento', '=', $request->num_documento)
                    ->first();

        if ($cliente !== null) {
            return response()->json([
                'message' => "El cliente '$request->nombre' ya existe.",
                'id'      => $cliente->id
            ], 201);
        }

        $cliente = new Cliente();

        $cliente->nombre = $request->nombre;
        $cliente->tipo_documento = $request->tipo_documento;
        $cliente->num_documento = $request->num_documento;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;

        $cliente->save();

        return response()->json([
            'message' => "El cliente '$request->nombre' fue registrado con exito",
            'id'      => $cliente->id
        ], 201);
    }

    // Eliminar cliente
    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json([
                'message' => 'El cliente no existe',
            ], 404);
        }

        $nombre_cliente = $cliente->nombre;
        $cliente->delete();

        return response()->json([
            'message' => "El cliente $nombre_cliente fue eliminado",
        ], 200);
    }

}
