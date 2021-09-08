
<!DOCTYPE html>
<html lang="es" ng-app="MiApp" >

<head>
	
	<title>Inventario</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
    
    <link rel="stylesheet" href="{{ asset('librerias_aparte/bootstrap.min.css') }}">
    <link  rel="stylesheet" href="{{ asset('librerias_aparte/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('librerias_aparte/estilousco.css') }}">


    <script  src="{{ asset('librerias_aparte/jquery.min.js') }}"></script>
    <script  src="{{ asset('librerias_aparte/angular.min.js') }}"></script>
    <script  src="{{ asset('librerias_aparte/bootstrap.min.js') }}"></script>
    <script  src="{{ asset('librerias_aparte/popper.min.js') }}"></script>
    <script  src="{{ asset('librerias_aparte/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('funcionalidad/soy-cliente.js') }}"></script>
    
    
    

    
	
</head>

<body ng-controller="ControladorPrincipal as ctrl">
<!-- SAGL -->
<div class="container-fluid" >
		
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <h1>Factura (Comprar Productos)</h1>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
        <button class="btn btn-usco-primary" ng-click="ctrl.volverMenu()"> << Volver al menú</button>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            Cliente que realiza la compra
            <select ng-model="ctrl.campoCliente" id="campoCliente" class="form-control" ng-change="ctrl.elegirCliente()">
                <option ng-repeat="x in ctrl.listadoClientes" value="@{{x.id}}">
                @{{x.tipo_documento}} - @{{x.num_documento}} - @{{x.nombre}}
                </option>
            </select>
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="row" ng-if="ctrl.hayClienteElegido">
        <div class="col-md-6">
            <h3>Comprar Productos</h3>
            <p>En el siguiente formulario puede elegir el producto a comprar.</p>
            <form novalidate>
            <div class="row mb-1">
                    <div class="col-md-4">
                        Producto
                    </div>
                    <div class="col-md-8">
                        <select ng-model="ctrl.campoProducto" class="form-control">
                            <option ng-repeat="x in ctrl.listadoProductos" value="@{{x.id}}">
                            $@{{x.precio_unidad}} - @{{x.nombre_producto}}  (Disp. @{{x.cantidad}})
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-4">
                        Cantidad
                    </div>
                    <div class="col-md-8">
                    <input type="number" ng-model="ctrl.campoCantidad" class="form-control">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                    <button class="btn btn-usco-primary btn-block" ng-click="ctrl.crearFactura()">Guardar Producto en la Factura</button>
                    </div>
                </div>               
            </form>
        </div>
        <div class="col-md-6">
            <h3>Productos en la factura</h3>
            <p>El siguiente es el listado de productos que el cliente ha agregado a la factura.</p>
            <table class="table table-sm table-hover table-bordered">
                <thead>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Lote</th>
                    <th>Fecha Venc.</th>
                    <th>Precio/Unid</th>
                    <th>Precio/Subtotal</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in ctrl.listadoProductosPorFactura">
                        <td>@{{item.nombre_producto}}</td>
                        <td>@{{item.catidad}}</td><!-- catidad sin n, es la de la facutra -->
                        <td>@{{item.lote}}</td>
                        <td>@{{item.vencimiento}}</td>
                        <td>$@{{item.precio_unidad}}</td>
                        <td>$@{{item.subTotal}}</td>
                        <td>
                            <button class="btn btn-sm btn-usco-primary" ng-click="ctrl.eliminarProducto()">
                                x
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
        <p class="text-center">
            <br><br>
            <small>
                Pie de página
            </small>
            <br><br>
        </p>
        </div>
    </div>

</div>

</body>
</html>