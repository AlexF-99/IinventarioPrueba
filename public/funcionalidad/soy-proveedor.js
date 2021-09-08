(function () {
    'use strict'
    angular.module('MiApp', [])
        .controller('ControladorPrincipal', ControladorPrincipal);

    function ControladorPrincipal($http, $rootScope) {
        var vm = this;

        vm.campoNombre = "";
        vm.campoLote = "";
        vm.campoCantidad = 0;
        vm.campoPrecio = 0;
        vm.campoFechaVencimiento = undefined;
        


        vm.listadoProductos = [];
        vm.cargarListadoProductos = cargarListadoProductos;
        vm.guardarProducto = guardarProducto;
        vm.volverMenu = volverMenu;
        
        
		inicial();
		
		function inicial(){
			cargarListadoProductos();
		}

        function volverMenu(){
            location.href='/';
        }

        function cargarListadoProductos() {
            //mostrarSweetAlertCargando();
            vm.objeto = {};
            $http({
                url: "api/productos",
                method: "GET",
                data: vm.objeto
            }).then(function (response) {
                vm.listadoProductos = response.data.data;
                //cerrarSwal();
            }, function myError(response) {
                hayErrorPeticion();
            });
        }//fin metodo 


        function guardarProducto() {

            var salida = validarGuardarProducto();
            if(salida == ""){
                //si no es valido el formulario
                return;
            }            
            mostrarSweetAlertCargando();
            $http({
                url: "api/productos?"+salida,
                method: "POST",
                data: vm.objeto
            }).then(function (response) {
                var salida = response.data.message;
                mostrarSweetAlertSuccess(salida);
                cargarListadoProductos();
            }, function myError(response) {
                hayErrorPeticion(response);
            });
        }//fin metodo 


        function validarGuardarProducto(){
            if(vm.campoNombre == '' || vm.campoNombre.length < 2){
                mostrarSweetAlertWarning("Debe ingresar un nombre para el producto");
                return "";
            }
            if(!Number.isInteger(vm.campoCantidad) || vm.campoCantidad < 1){
                mostrarSweetAlertWarning("Debe ingresar una cantidad válida");
                return "";
            }
            if(vm.campoLote == '' || vm.campoLote.length < 2){
                mostrarSweetAlertWarning("Debe ingresar un lote para el producto");
                return "";
            }
            if(vm.campoFechaVencimiento == undefined){
                mostrarSweetAlertWarning("Debe ingresar una fecha válida");
                return "";
            }
            var fecha = vm.campoFechaVencimiento.toISOString().substring(0,10)

            if(fecha == undefined || fecha.length != 10){
                mostrarSweetAlertWarning("Debe ingresar una fecha válida");
                return "";
            }
            if(!Number.isInteger(vm.campoPrecio) || vm.campoPrecio < 1){
                mostrarSweetAlertWarning("Debe ingresar un precio válido");
                return "";
            }

            var urlParams = "";
            urlParams = urlParams + "nombre_producto="+vm.campoNombre;
            urlParams = urlParams + "&lote="+vm.campoLote;
            urlParams = urlParams + "&cantidad="+vm.campoCantidad;
            urlParams = urlParams + "&vencimiento="+fecha;
            urlParams = urlParams + "&precio="+vm.campoPrecio;
            //urlParams = encodeURIComponent(urlParams);

            return urlParams;
        }

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