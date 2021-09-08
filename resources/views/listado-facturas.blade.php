
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
    <script src="{{ asset('funcionalidad/listado-facturas.js') }}"></script>


    
	
</head>

<body ng-controller="ControladorPrincipal as ctrl" >
<!-- SAGL -->
<div class="container-fluid" class="html-content">
		
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <h1>Listado del Inventario</h1>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
        <button class="btn btn-usco-primary" ng-click="ctrl.volverMenu()"> << Volver al menú</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <h3>Listado Facturas</h3>
            <p>En el siguiente listado puede ver las facturas registradas.</p>
            <table class="table table-sm table-hover table-bordered">
                <thead>
                    <th>Id</th>
                    <th>Fecha</th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in ctrl.listadoFacturas">
                        <td>@{{item.id}}</td>
                        <td>@{{item.fecha}}</td>
                        <td>
                            <button class="btn btn-sm btn-usco-primary"
                                ng-click="ctrl.cargarListadoProductosPorFactura(item)">
                                Ver
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-8">
        <h3>Listado Productos por Factura</h3>
            <p>En el siguiente listado puede los productos de una factura.</p>
            Cliente: @{{ctrl.datosClienteFactura.tipo_documento}} - @{{ctrl.datosClienteFactura.num_documento}} - 
            @{{ctrl.datosClienteFactura.nombre}}
            <table class="table table-sm table-hover table-bordered">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Lote</th>
                    <th>Cantidad</th>
                    <th>Fecha Venc.</th>
                    <th>Precio/Unidad</th>
                    <th>Precio/Subtotal</th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in ctrl.listadoProductosPorFactura">
                        <td>@{{item.id}}</td>
                        <td>@{{item.nombre_producto}}</td>
                        <td>@{{item.lote}}</td>
                        <td>@{{item.catidad}}</td>
                        <td>@{{item.vencimiento}}</td>
                        <td>@{{item.precio_unidad}}</td>
                        <td>@{{item.precio_subtotal}}</td>
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