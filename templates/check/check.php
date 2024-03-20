<?php

require_once "../dashboard/functions.php";
require_once "../generalFunctions/datosCliente.php";


?>


<!DOCTYPE html>
<html lang="en">
<?php include '../components/head.php'; ?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include '../components/slidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                <?php include '../components/topbar.php'; ?>   

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">

                        <!-- INGRESO DE DOCUMENTO PARA MARCAR ASISTENCIA -->
                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Registra tu asistencia </div>
                                                
                                                    <input type="number" class="form-control" id="clienteIdInput" name="clienteId" placeholder="123456789" onkeypress="checkKey(event)">
                                                
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <!-- Content Row -->
                    <div class="row"> 

                         <!-- NOMBRE -->                  
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center " >
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Bienvenido</div>
                                            <div id="nombreApellidoCliente" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center"> <!-- Agregamos las clases d-flex y align-items-center -->
                                            <i class="fas fa-user fa-2x text-gray-500"></i>                                           
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- INICIO DE MEMBRESIA -->  
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center" >
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Iniciaste membresia el:</div>
                                            <div id="inicio" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                            <i class="fas fa-calendar-day fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- DIAS DE MEMBRESIA -->  
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Dias de Membresia:</div>
                                            <div id="dias" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                        <i class="fas fa-address-card fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- REGISTRO -->  
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Fecha de registro:</div>
                                            <div id="registro" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center">
                                        <i class="fas fa-calendar-check fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="../../resources/vendor/jquery/jquery.min.js"></script>
    <script src="../../resources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../resources/js/sb-admin-2.min.js"></script>

    <script>
        $(document).ready(function(){
            $("#clienteIdInput").keypress(function(event){
                if(event.which == 13){
                    var clienteId = $(this).val();
                    
                    $.ajax({
                        url: '../customers/marcarAsistencia.php',
                        type: 'POST',
                        data: {clienteId: clienteId},
                        dataType: 'json',
                        success: function(response){
                            if(response.error){
                                $("#resultado").text(response.error);
                            } else {
                                // Captura los datos retornados en variables
                                var nombreCliente = response.nombre;
                                var apellidoCliente = response.apellido;
                                var fechaInicioMembresia = response.fecha_inicio_membresia;
                                var diasMembresia = response.diasMembresia;
                                var fechaRegistro = response.fechaRegistro;
                                
                                // Actualiza el contenido del elemento con el ID nombreApellidoCliente
                                $("#nombreApellidoCliente").text(nombreCliente + ' ' + apellidoCliente);
                                $("#inicio").text(fechaInicioMembresia);
                                $("#dias").text(diasMembresia + " Dias");
                                $("#registro").text(fechaRegistro);
                                }
                        },
                        error: function(xhr, status, error){
                            $("#resultado").text("Error al marcar la asistencia: " + error);
                        }
                    });
                }
            });
        });
    </script>

    <script>
        // Seleccionar el input
        var input = document.getElementById("identificacion");
        // Habilitar el input al cargar la página
        input.disabled = false;
        // Enfocar el input para que el usuario pueda escribir directamente
        input.focus();
        
    </script>


</body>

</html>
