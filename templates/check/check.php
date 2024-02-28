<?php

// Iniciar sesión
session_start();
require_once "../dashboard/functions.php";

function marcarAsistencia($clienteId, $conexion) {
    $fechaActual = date("Y-m-d");

    // Verificar si ya existe un registro de asistencia para este cliente y la fecha actual
    $sql = "SELECT * FROM asistencia WHERE cliente_id = $clienteId AND fecha = '$fechaActual'";
    $resultado = $conexion->query($sql);

    $sql = "SELECT `nombre`, `apellido` FROM `clientes` WHERE `id` = $clienteId";
    $cliente = $conexion->query($sql);

    if ($resultado->num_rows == 0 && $cliente->num_rows == 1 ) {
        // No existe un registro de asistencia, insertar uno nuevo
        $sqlInsert = "INSERT INTO asistencia (cliente_id, fecha) VALUES ($clienteId, '$fechaActual')";
        if ($conexion->query($sqlInsert) === TRUE) {
            // Obtener los datos del cliente
            $sqlCliente = "SELECT * FROM clientes WHERE id = $clienteId";
            $resultadoCliente = $conexion->query($sqlCliente);
            if ($resultadoCliente !== false && $resultadoCliente->num_rows > 0) {
                $cliente = $resultadoCliente->fetch_assoc();
                $nombre = $cliente['nombre'];
                $apellido = $cliente['apellido'];
                $telefono = $cliente['telefono'];
                $fechaInicioMembresia = $cliente['fecha_inicio_membresia'];
                $diasMembresia = $cliente['diasMembresia'];
                $fechaRegistro = $cliente['fechaRegistro'];
                
                // Retornar los datos del cliente
                return [
                    'success' => true,
                    'message' => "Asistencia marcada correctamente para: $nombre $apellido",
                    'telefono' => $telefono,
                    'fechaInicioMembresia' => $fechaInicioMembresia,
                    'diasMembresia' => $diasMembresia,
                    'fechaRegistro' => $fechaRegistro
                ];
            } else {
                return ['success' => false, 'message' => "Error al obtener los datos del cliente."];
            }
        } else {
            return ['success' => false, 'message' => "Error al marcar la asistencia: " . $conexion->error];
        }
    } else {
        // Ya existe un registro de asistencia para este cliente y la fecha actual
        return ['success' => false, 'message' => "Ya se ha marcado la asistencia para este cliente hoy."];
    }
}

global $nombre;

function consultarClientePorId($conexion, $clienteId) {
    // Consulta SQL
    $sql = "SELECT `nombre`, `apellido` FROM `clientes` WHERE `id` = $clienteId";

    // Ejecutar la consulta
    $resultado = $conexion->query($sql);

    // Verificar si la consulta fue exitosa
    if ($resultado !== false && $resultado->num_rows > 0) {
        // Obtener el registro consultado
        $cliente = $resultado->fetch_assoc();

        // Construir el string con el nombre y apellido del cliente
        $nombre = $cliente['nombre'] . ' ' . $cliente['apellido'];
                
        // Retornar el string con el nombre y apellido del cliente
        return $nombre;
    } else {
        // Si la consulta falla o no devuelve resultados, retornar un mensaje de error
        $nombre="no encontrado";
        return $nombre;
    }
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clienteId = $_POST['clienteId'];
    $resultado = marcarAsistencia($clienteId, $conexion);
    if ($resultado['success']) {
        error_log($resultado['message']);
        $nombre= consultarClientePorId($conexion, $clienteId);
    } else {
        error_log($resultado['message']);
    }
}
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
                                                <form action="" method="POST">
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
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
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
