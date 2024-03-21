<?php
require_once "functions.php";
require_once "../generalFunctions/datosCliente.php";

$asistenciasPorDia = contarAsistenciasPorDia($conexion, 7);
$asistenciasPorDiaJSON = json_encode($asistenciasPorDia);
?>


<!DOCTYPE html>
<html lang="en">
<?php include '../components/head.php'; ?>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            
                </ul>
                </nav>

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
                    <div>
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
                                
                                $("#registro").text(fechaRegistro);

                                // Obtener la fecha actual
                                var fechaActual = new Date();

                                // Convertir la fecha de inicio de membresía a objeto Date
                                var fechaInicioMembresia = new Date(fechaInicioMembresia);

                                // Calcular la diferencia en días entre las dos fechas
                                var diferenciaEnDias = Math.floor((fechaActual - fechaInicioMembresia) / (1000 * 60 * 60 * 24));

                                $("#dias").text(diferenciaEnDias+ " de " +diasMembresia );
                                
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

    <!-- Page level plugins -->
    <script src="../../resources/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../resources/js/demo/chart-area-demo.js"></script>
    <script src="../../resources/js/demo/chart-pie-demo.js"></script>

    <script>
        // Seleccionar el input
        var input = document.getElementById("identificacion");
        // Habilitar el input al cargar la página
        input.disabled = false;
        // Enfocar el input para que el usuario pueda escribir directamente
        input.focus();
        
    </script>

    <script>
    

    var etiquetas = ["Membresias Vencidas", "Membresias Activas"]; // Ejemplo de etiquetas
    var backgroundColors = ['#1cc88a','#f6c23e']; // Ejemplo de colores de fondo
    var hoverBackgroundColors = ['#035236', '#D1990A']; // Ejemplo de colores de fondo al pasar el mouse
    var datos = ['10', '20']; // Ejemplo de datos
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
