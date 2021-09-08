(function () {
    'use strict'
    angular.module('MiApp', [])
        .controller('ControladorPrincipal', ControladorPrincipal);

    function ControladorPrincipal($http, $rootScope) {
        var vm = this;

        vm.campoNombre = "";
        vm.campoFechaVencimiento = undefined;
        vm.mostrarFormulario = false;
        vm.productoSeleccionado = {};
        vm.datosClienteFactura = {};
        


        vm.listadoProductosPorFactura = [];
        vm.listadoFacturas = [];

        vm.cargarListadoFacturas = cargarListadoFacturas;
        vm.cargarListadoProductosPorFactura = cargarListadoProductosPorFactura;

        vm.volverMenu = volverMenu;
        
        
		inicial();
		
		function inicial(){
			cargarListadoFacturas();
		}

        function volverMenu(){
            location.href='/';
        }

        function cargarListadoFacturas() {
            vm.objeto = {};
            $http({
                url: "api/facturas",
                method: "GET",
                data: vm.objeto
            }).then(function (response) {
                vm.listadoFacturas = response.data.data;
                console.log(vm.listadoFacturas);
            }, function myError(response) {
                hayErrorPeticion(response);
            });
        }//fin metodo 


        function cargarListadoProductosPorFactura(facturaSeleccionada) {
            mostrarSweetAlertCargando();
            vm.objeto = {};
            $http({
                url: "api/facturas/"+facturaSeleccionada.id,
                method: "GET",
                data: vm.objeto
            }).then(function (response) {
                cerrarSwal();
                vm.listadoProductosPorFactura = response.data.productos;
                vm.datosClienteFactura = response.data.cliente;
                vm.listadoProductosPorFactura.forEach((elemento, index)=>{
                    var subTotal = elemento.catidad * elemento.precio_unidad;
                    vm.listadoProductosPorFactura[index].precio_subtotal = subTotal;
                });
                console.log("Producto de la facutra");
                console.log(vm.listadoProductosPorFactura);
            }, function myError(response) {
                hayErrorPeticion(response);
            });
        }//fin metodo 

        

        
        //====================================
        //-------- mensajitos ---------------//
        //====================================
        
        function hayErrorPeticion(response){
            cerrarSwal();
            mostrarSweetAlertError("Error al procesar la operación");
            console.error(response.data);
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