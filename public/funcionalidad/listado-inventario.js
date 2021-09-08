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
        


        vm.listadoProductos = [];
        vm.cargarListadoProductos = cargarListadoProductos;
        vm.volverMenu = volverMenu;
        vm.editarProducto = editarProducto;
        vm.habilitarFormularioEditar = habilitarFormularioEditar;
        vm.CreatePDFfromHTML = CreatePDFfromHTML;
        
        
		inicial();
		
		function inicial(){
			cargarListadoProductos();
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


        function habilitarFormularioEditar(item){
            vm.productoSeleccionado = item;
            vm.mostrarFormulario = true;

            vm.campoNombre = vm.productoSeleccionado.nombre_producto;
            
            var fecha = new Date(vm.productoSeleccionado.vencimiento+'T00:00:00');
            vm.campoFechaVencimiento = fecha;
        }



        function editarProducto() {
            var salida = validarEditarProducto();
            if(salida == ""){
                //si no es valido el formulario
                return;
            }            
            mostrarSweetAlertCargando();
            $http({
                url: "api/productos/"+vm.productoSeleccionado.id+"?"+salida,
                method: "PUT",
                data: vm.objeto
            }).then(function (response) {
                var salida = response.data.message;
                vm.mostrarFormulario = false;
                mostrarSweetAlertSuccess(salida);
                cargarListadoProductos();
            }, function myError(response) {
                hayErrorPeticion(response);
            });
        }//fin metodo 


        function validarEditarProducto(){
            if(vm.campoNombre == '' || vm.campoNombre.length < 2){
                mostrarSweetAlertWarning("Debe ingresar un nombre válido para el producto");
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
            var urlParams = "";
            urlParams = urlParams + "nombre_producto="+vm.campoNombre;
            urlParams = urlParams + "&vencimiento="+fecha;
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