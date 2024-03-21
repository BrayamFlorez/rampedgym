<?php
// Iniciar sesión
session_start();
require_once "functions.php";
require_once "../../resources/sesion.php";
require_once "../generalFunctions/fechaHora.php";

$asistenciasPorDia = contarAsistenciasPorDia($conexion, 7);
$asistenciasPorDiaJSON = json_encode($asistenciasPorDia);
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

                <?php include '../components/topbar.php'; ?>   

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Bienvenido <?php echo $usuario; ?></h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generar reporte</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="../customers/clients.php" class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Clientes Registrados</a>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_clientes; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Asistencias Diarias</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalAsistencias; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-list fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rutinas registradas
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total_rutinas; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Membresias</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_menores_30_dias; ?> Activas</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_mayores_30_dias; ?> Inactivas</div>
                                            </div>
                                        <div class="col-auto">
                                        <i class="fas fa-check fa-2x text-gray-500"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Pie Chart -->
                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <a href="../customers/clients.php"
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6  class="m-0 font-weight-bold text-primary">Asistencias</h6>
                                    </a>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-pie pt-4 pb-2">
                                            <canvas id="Asistencias"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-danger"></i> No Asistidos
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-success"></i> Asistidos
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pie Chart -->
                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <a href="../customers/clients.php"
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Membresias</h6>
                                    </a>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-pie pt-4 pb-2">
                                            <canvas id="Membresias"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-warning"></i> Vencidas
                                            </span>
                                            <span class="mr-2">
                                                <i class="fas fa-circle text-success"></i> Activas
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- grafico historico -->
                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div
                                        class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Asistencias Historicas</h6>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-area pt-4 pb-2">
                                            <canvas id="myAreaChart"></canvas>
                                        </div>
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

    <!-- Core plugin JavaScript-->
    <script src="../../resources/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../resources/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../resources/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../resources/js/demo/chart-area-demo.js"></script>
    <script src="../../resources/js/demo/chart-pie-demo.js"></script>

    <script>
    // Llamamos a la función crearGraficoPie con los datos adecuados
    var datos = ['<?php echo $totalAsistencias; ?>', '<?php echo $total_clientes-$totalAsistencias; ?>']; // Ejemplo de datos
    var etiquetas = ["Asistidos", "No asistidos"]; // Ejemplo de etiquetas
    var backgroundColors = ['#1cc88a','#e74a3b']; // Ejemplo de colores de fondo
    var hoverBackgroundColors = ['#035236', '#6A0F06']; // Ejemplo de colores de fondo al pasar el mouse
    
    crearGraficoPie(datos, etiquetas, backgroundColors, hoverBackgroundColors, "Asistencias");

    var etiquetas = ["Membresias Vencidas", "Membresias Activas"]; // Ejemplo de etiquetas
    var backgroundColors = ['#1cc88a','#f6c23e']; // Ejemplo de colores de fondo
    var hoverBackgroundColors = ['#035236', '#D1990A']; // Ejemplo de colores de fondo al pasar el mouse
    var datos = ['<?php echo $total_menores_30_dias; ?>', '<?php echo $total_mayores_30_dias; ?>']; // Ejemplo de datos
    crearGraficoPie(datos, etiquetas, backgroundColors, hoverBackgroundColors, "Membresias");

    // Uso de la función con datos específicos
    var asistenciasPorDia = <?php echo $asistenciasPorDiaJSON; ?>;

    // Obtener las claves y los valores del objeto JSON
    var labels = Object.keys(asistenciasPorDia);
    var data = Object.values(asistenciasPorDia);
    generarGraficoArea(labels, data, "Asistencias", "myAreaChart");
    </script>
    

</body>

</html>
