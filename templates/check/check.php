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

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-12 col-md-12 mb-12">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Registra tu asistencia </div>
                                                <form action="../customers/marcarAsistencia.php" method="POST">
                                                    <input type="number" class="form-control" id="identificacion" name="clienteId" placeholder="123456789" onkeypress="checkEnter(event)">
                                                </form>
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
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Bienvenido</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nombre; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Iniciaste membresia el:</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $inicio; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Has asistido:</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-500"></i>
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
    function checkEnter(event) {
        if (event.keyCode == 13) {
            document.querySelector('form').submit();
        }
    }
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
