
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
    <script src="{{ asset('funcionalidad/listado-inventario.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

    
	
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
        <div class="col-md-6">
            <h3>Listado Productos</h3>
            <p>En el siguiente formulario puede editar un producto.</p>
            <table class="table table-sm table-hover table-bordered">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Lote</th>
                    <th>Fecha Venc.</th>
                    <th>Precio</th>
                    <th></th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in ctrl.listadoProductos">
                        <td>@{{item.id}}</td>
                        <td>@{{item.nombre_producto}}</td>
                        <td>@{{item.cantidad}}</td>
                        <td>@{{item.lote}}</td>
                        <td>@{{item.vencimiento}}</td>
                        <td>$@{{item.precio_unidad}}</td>
                        <td>
                            <button class="btn btn-usco-primary btn-sm" ng-click="ctrl.habilitarFormularioEditar(item)">
                                Editar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6" ng-if="ctrl.mostrarFormulario == true">
            <h3>Editar Producto</h3>
            <p>En el siguiente formulario puede editar un producto.</p>
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
                        Fecha Vencimiento
                    </div>
                    <div class="col-md-8">
                    <input type="date" ng-model="ctrl.campoFechaVencimiento" class="form-control">
                    </div>
                </div> 
                <div class="row mb-1">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-8">
                    <button class="btn btn-usco-primary btn-block" ng-click="ctrl.editarProducto()">
                        Editar
                    </button>
                    </div>
                </div>               
            </form>
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