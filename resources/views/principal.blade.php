
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

    
	
</head>

<body ng-controller="ControladorPrincipal as ctrl">
<!-- SAGL -->
<div class="container-fluid" ng-controller="ControladorPrincipal as ctrl">
		
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<br>
				<h1 class="text-center">Sistema Inventario Simple</h1>
				
				<br>
                <div>
                    <button class="btn btn-usco-primary btn-block" ng-click="ctrl.ingresarComoProveedor()">
                        Ingresar como Proveedor
                    </button>
                    <button class="btn btn-usco-primary btn-block" ng-click="ctrl.ingresarComoCliente()">
                        Ingresar como Cliente
                    </button>
                    <button class="btn btn-usco-primary btn-block" ng-click="ctrl.ingresarListadoInventario()">
                        Listado de inventario
                    </button>
                    <button class="btn btn-usco-primary btn-block" ng-click="ctrl.ingresarListadoFacturas()">
                        Listado de facturas
                    </button>
                </div>
				<br>

				<p class="text-center">
					<small>
						Pie de página
					</small>
				</p>
			</div>
			<div class="col-md-3"></div>
		</div>


    </div>
    
    <script src="{{ asset('funcionalidad/inicio.js') }}"></script>

</body>
</html>