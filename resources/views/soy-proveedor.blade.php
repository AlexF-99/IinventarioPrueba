
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
    <script src="{{ asset('funcionalidad/soy-proveedor.js') }}"></script>

    
	
</head>

<body ng-controller="ControladorPrincipal as ctrl">
<!-- SAGL -->
<div class="container-fluid" >
		
    <div class="row mb-3">
        <div class="col-md-12 text-center">
            <h1>Proveedores</h1>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
        <button class="btn btn-usco-primary" ng-click="ctrl.volverMenu()"> << Volver al menú</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h3>Crear nuevo producto</h3>
            <p>En el siguiente formulario puede crear un producto.</p>
            <form novalidate>
                <div class="row mb-1">
                    <div class="col-md-4">
                        Nombre Producto
                    </div>
                    <div class="col-md-8">
                        <input type="text" ng-model="ctrl.campoNombre" class="form-control">
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
                        Lote
                    </div>
                    <div class="col-md-8">
                    <input type="text" ng-model="ctrl.campoLote" class="form-control">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-4">
                        Fecha Vencimiento
                    </div>
                    <div class="col-md-8">
                    <input type="date" ng-model="ctrl.campoFechaVencimiento" class="form-control">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-4">
                        Precio
                    </div>
                    <div class="col-md-8">
                    <input type="number" ng-model="ctrl.campoPrecio" class="form-control">
                    </div>
                </div> 
                <div class="row mb-1">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                    <button class="btn btn-usco-primary btn-block" ng-click="ctrl.guardarProducto()">Guardar</button>
                    </div>
                </div>               
            </form>
        </div>
        <div class="col-md-6">
            <h3>Listado Productos</h3>
            <p>El siguiente es el listado de productos existentes.</p>
            <table class="table table-sm table-hover table-bordered">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Lote</th>
                    <th>Fecha Venc.</th>
                    <th>Precio</th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in ctrl.listadoProductos">
                        <td>@{{item.id}}</td>
                        <td>@{{item.nombre_producto}}</td>
                        <td>@{{item.cantidad}}</td>
                        <td>@{{item.lote}}</td>
                        <td>@{{item.vencimiento}}</td>
                        <td>$@{{item.precio_unidad}}</td>
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