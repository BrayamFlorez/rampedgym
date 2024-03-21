<?php
// Iniciar sesión
session_start();
require_once "../dashboard/functions.php";
require_once "listClients.php";
require_once "../../resources/sesion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $id = $_POST["id"];
    $fecha_inicio = $_POST["fecha_inicio"];
    $dias_memmbresia = $_POST["diasMembresia"];

    // Obtener la fecha actual
    $fecha_registro = date("Y-m-d");

    // Prepara la consulta SQL para insertar los datos en la tabla de clientes
    $sql = "INSERT INTO clientes (id, nombre, apellido, telefono, fecha_inicio_membresia, diasMembresia, fechaRegistro) 
            VALUES ('$id','$nombre', '$apellido', '$telefono', '$fecha_inicio','$dias_memmbresia','$fecha_registro')";

    // Ejecuta la consulta y muestra un mensaje de éxito o error
    if ($conexion->query($sql) === TRUE) {
        error_log( "Cliente registrado correctamente, por favor no recargue la pagina, de click en clientes si quiere crear un cliente nuevo");       
        header("../dashboard/welcome.php");
    } else {
        error_log( "Error al registrar el cliente: " . $conexion->error);
        header("../dashboard/welcome.php");
    }
}

// Procesar búsqueda si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["busqueda"])) {
    $busqueda = $_GET["busqueda"];
} else {
    $busqueda = null;
}



?>

<!DOCTYPE html>
<html lang="en">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
                <button id="toggleFormulario" class="btn btn-primary">Mostrar formulario de registro</button></br></br>

                    <div class="row" id="formularioRegistro" style="display:none;">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h4 class="mb-4">Registro de clientes</h4>
                                    <form action="" method="POST" >
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="apellido">Apellido:</label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="telefono">Telefono:</label>
                                                <input type="number" class="form-control" id="telefono" name="telefono">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                        <div class="form-group col-md-3">
                                                <label for="id">Identificacion:</label>
                                                <input type="number" class="form-control" id="id" name="id">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="fecha_inicio">Inicio de membresia:</label>
                                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                                            </div>  
                                            <div class="form-group col-md-3">
                                                <label for="diasMembresia">Dias de Membresia:</label>
                                                <input type="number" class="form-control" id="diasMembresia" name="diasMembresia" required>
                                            </div>  
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">Registrar</button> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                   

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                 
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <!-- formulario de busqueda -->
                                        <form action="" method="GET" class="row">
                                            <div class="form-group row">
                                                <input type="text" class="form-control col-lg-8" id="busqueda" name="busqueda" placeholder="Buscar...">
                                                <div class=" col-lg-1"></div>
                                                <button type="submit" class="btn btn-primary col-lg-2">Buscar</button>
                                            </div>                                    
                                        </form>
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><i class="far fa-check-circle"></i></th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Apellido</th>                                                    
                                                    <th scope="col">Celular</th>
                                                    <th scope="col">Inicio</th>
                                                    <th scope="col">Membresia</th>
                                                    <th scope="col">Fin</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php mostrarClientes($conexion, $busqueda); ?>
                                            </tbody>
                                        </table>
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

    <!-- Funcion para ocultar formulario -->
    <script>
    var formularioVisible = false;

    document.getElementById('toggleFormulario').addEventListener('click', function() {
        if (formularioVisible) {
            document.getElementById('formularioRegistro').style.display = 'none';
            document.getElementById('toggleFormulario').textContent = 'Mostrar formulario de registro';
        } else {
            document.getElementById('formularioRegistro').style.display = 'block';
            document.getElementById('toggleFormulario').textContent = 'Ocultar formulario de registro';
        }
        formularioVisible = !formularioVisible;
    });
    </script>

    



</body>

</html>