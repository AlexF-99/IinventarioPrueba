(function () {
    'use strict'
    angular.module('MiApp', [])
        .controller('ControladorPrincipal', ControladorPrincipal);

    function ControladorPrincipal($http, $rootScope) {
        var vm = this;

        vm.campoCantidad = 0; //cantidad del producto
        vm.campoCliente = undefined; //id del cliente
        vm.campoProducto = undefined; //id del producto

        vm.listadoClientes = [];
        vm.listadoProductos = [];
        vm.listadoProductosPorFactura = [];
        vm.hayClienteElegido = false;
        vm.facturaId = undefined; //id de la factura


        vm.volverMenu = volverMenu;
        vm.cargarListadoProductos = cargarListadoProductos;
        vm.cargarListadoClientes = cargarListadoClientes;
        vm.elegirCliente = elegirCliente;
        vm.crearFactura = crearFactura;
        vm.eliminarProducto = eliminarProducto;
        
        
        
		inicial();
		
		function inicial(){
			cargarListadoProductos();
            cargarListadoClientes();
		}

        function volverMenu(){
            location.href='/';
        }

        function cargarListadoProductos() {
            vm.objeto = {};
            $http({
                url: "api/productos",
                method: "GET",
                data: vm.objeto
            }).then(function (response) {
                vm.listadoProductos = response.data.data;
            }, function myError(response) {
                hayErrorPeticion();
            });
        }//fin metodo 

        function cargarListadoClientes() {
            vm.objeto = {};
            $http({
                url: "api/clientes",
                method: "GET",
                data: vm.objeto
            }).then(function (response) {
                vm.listadoClientes = response.data.data;
            }, function myError(response) {
                hayErrorPeticion();
            });
        }//fin metodo 

        function elegirCliente(){
            vm.hayClienteElegido = true;
            document.getElementById("campoCliente").readOnly  = true;
        }
        

        function crearFactura() {
            //si no tiene una factura id creada, la genera
            if(vm.facturaId == undefined){
                vm.objeto = {};
                $http({
                    url: "api/facturas?id_cliente="+vm.campoCliente,
                    method: "POST",
                    data: vm.objeto
                }).then(function (response) {
                    vm.facturaId = response.data.id;//guarda el id de la factura generada
                    if(Number.isInteger(vm.facturaId)){//si es un id, sigue
                        crearProductoFactura();
                    }
                }, function myError(response) {
                    hayErrorPeticion();
                });
            }else{
                //si ya tiene una factura id creada, manda a guarda el producto en esa factura
                crearProductoFactura();
            }
            
        }//fin metodo 
        

        function crearProductoFactura() {
            var salida = validarCrearProductoFactura();
            if(salida == ""){
                return;
            }

            vm.objeto = {};
            $http({
                url: "api/facturas/producto?"+salida,
                method: "POST",
                data: vm.objeto
            }).then(function (response) {
                cargarListadoProductosPorFactura();
            }, function myError(response) {
                hayErrorPeticion(response);
            });
        }//fin metodo 


        function validarCrearProductoFactura(){
            if(!Number.isInteger(vm.campoCantidad) || vm.campoCantidad < 1){
                mostrarSweetAlertWarning("Debe ingresar una cantidad válida");
                return "";
            }
            var productoId = parseInt(vm.campoProducto);
            if(!Number.isInteger(productoId) || productoId < 1){
                console.log("Debe elegir un producto");
                console.log(vm.campoProducto);
                mostrarSweetAlertWarning("Debe elegir un producto");
                return "";
            }
            if(!Number.isInteger(vm.facturaId) || vm.facturaId < 1){
                console.log("Debe tener una factura creada");
                console.log(vm.facturaId);
                mostrarSweetAlertWarning("Debe tener una factura creada");
                return "";
            }

            var urlParams = "";
            urlParams = urlParams + "id_factura="+vm.facturaId;
            urlParams = urlParams + "&id_producto="+productoId;
            urlParams = urlParams + "&cantidad="+vm.campoCantidad;

            return urlParams;
        }


        function cargarListadoProductosPorFactura() {
            vm.objeto = {};
            $http({
                url: "api/facturas/"+vm.facturaId,
                method: "GET",
                data: vm.objeto
            }).then(function (response) {
                vm.listadoProductosPorFactura = response.data.productos;
                vm.listadoProductosPorFactura.forEach((elemento, index)=>{
                    var subTotal = elemento.catidad * elemento.precio_unidad;
                    vm.listadoProductosPorFactura[index].subTotal = subTotal;
                });
                console.log("Estos son los producto de la factura");
                console.log(vm.listadoProductosPorFactura);
                cargarListadoProductos();
                mostrarSweetAlertSuccess("Se agregó el producto a la factura");

            }, function myError(response) {
                hayErrorPeticion(response);
            });
        }//fin metodo 


        function eliminarProducto(){
            /* NO HAY BACKEND PARA ELIMINAR UN PRODUCTO POR FACUTRA */
        }


        //====================================
        //-------- mensajitos ---------------//
        //====================================
        
        function hayErrorPeticion(response){
            cerrarSwal();
            mostrarSweetAlertError(response.data.errors);
            console.error(response.data.errors);
        }

        function mostrarSweetAlertWarning(mje) {
            console.log(mje);
            swal({
                title: "Atención",
                html: mje,
                type: 'warning',
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'OK',
                confirmButtonClass: 'btn btn-usco-primary',
                buttonsStyling: false
            }).then((result) => {
                if (result.value) {
                    //si se pulsa el boton
                }
            }).catch(swal.noop);
        }

        function mostrarSweetAlertSuccess(mje) {

            swal({
                title: "Bien",
                html: mje,
                type: 'success',
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'OK',
                confirmButtonClass: 'btn btn-usco-primary',
                buttonsStyling: false
            }).then((result) => {
                if (result.value) {
                    //si se pulsa el boton
                }
            }).catch(swal.noop);
        }

        function mostrarSweetAlertError(mje) {

            swal({
                title: "Error",
                html: mje,
                type: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                confirmButtonText: 'OK',
                confirmButtonClass: 'btn btn-usco-primary',
                buttonsStyling: false
            }).then((result) => {
                if (result.value) {
                    //si se pulsa el boton
                }
            }).catch(swal.noop);
        }

        function mostrarSweetAlertCargando() {
            swal({
                title: "Procesando",
                text: 'Por favor espere...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    swal.showLoading()
                }
            }).catch(swal.noop);
        }

        function cerrarSwal(){
            swal.close();
        }

    }//fin ControladorPrincipal

})();//fin del archivo