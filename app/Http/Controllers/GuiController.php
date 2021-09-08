<?php

namespace App\Http\Controllers;


class GuiController extends Controller
{
    public function inicio(){
        return view('principal');
    }

    public function soyProveedor(){
        return view('soy-proveedor');
    }

    public function soyCliente(){
        return view('soy-cliente');
    }

    public function listadoInventario(){
        return view('listado-inventario');
    }

    public function listadoFacturas(){
        return view('listado-facturas');
    }
}