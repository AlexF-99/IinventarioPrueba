(function () {
    'use strict'
    angular.module('MiApp', [])
        .controller('ControladorPrincipal', ControladorPrincipal);

    function ControladorPrincipal($http, $rootScope) {
        var vm = this;

        vm.campoUsuario = "";
        vm.campoContrasena1 = "";
        vm.tokenCsrf = "";

        vm.ingresarComoProveedor = ingresarComoProveedor;
        vm.ingresarComoCliente = ingresarComoCliente;
        vm.ingresarListadoInventario = ingresarListadoInventario;
        vm.ingresarListadoFacturas = ingresarListadoFacturas;

		inicial();
		
		function inicial(){
			
		}


        function ingresarComoProveedor(){
            location.href="soy-proveedor";
        }
        function ingresarComoCliente(){
            location.href="soy-cliente";
        }
        function ingresarListadoInventario(){
            location.href="listado-inventario";
        }
        function ingresarListadoFacturas(){
            location.href="listado-facturas";
        }




        //====================================
        //-------- mensajitos ---------------//
        //====================================

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