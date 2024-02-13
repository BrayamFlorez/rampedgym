<?php
// Iniciar sesión
session_start();
require_once "../dashboard/functions.php";
require_once "listMachine.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $estado = $_POST['estado'];
    $fecha_adquisicion = $_POST['fecha_adquisicion'];
    $precio_adquisicion = $_POST['precio_adquisicion'];
    $ubicacion = $_POST['ubicacion'];

    // Prepara la consulta SQL para insertar los datos en la tabla de máquinas
    $sql = "INSERT INTO inventario_maquinas (nombre, marca, modelo, estado, fecha_adquisicion, precio_adquisicion, ubicacion) 
            VALUES ('$nombre', '$marca', '$modelo', '$estado', '$fecha_adquisicion', '$precio_adquisicion', '$ubicacion')";

    // Ejecuta la consulta y muestra un mensaje de éxito o error
    if ($conexion->query($sql) === TRUE) {
        echo "Máquina registrada correctamente";
    } else {
        echo "Error al registrar la máquina: " . $conexion->error;
    }
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

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                <?php include '../components/topbar.php'; ?>   

                <!-- Begin Page Content -->
                <div class="container-fluid">


                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <h4 class="mb-4">Registrar Máquina</h4>
                                    <form action="" method="POST">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="nombre">Nombre:</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="marca">Marca:</label>
                                                <input type="text" class="form-control" id="marca" name="marca" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="modelo">Modelo:</label>
                                                <input type="text" class="form-control" id="modelo" name="modelo" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="estado">Estado:</label>
                                                <select class="form-control" id="estado" name="estado" required>
                                                    <option value="Nuevo">Nuevo</option>
                                                    <option value="Usado">Usado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="fecha_adquisicion">Fecha de Adquisición:</label>
                                                <input type="date" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="precio_adquisicion">Precio de Adquisición:</label>
                                                <input type="number" class="form-control" id="precio_adquisicion" name="precio_adquisicion" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="ubicacion">Ubicación:</label>
                                                <input type="text" class="form-control" id="ubicacion" name="ubicacion" required>
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
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Marca</th>
                                                    <th>Modelo</th>
                                                    <th>Estado</th>
                                                    <th>Fecha de Adquisición</th>
                                                    <th>Precio de Adquisición</th>
                                                    <th>Ubicación</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php mostrarMaquinas($conexion); ?>
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

</body>

</html>
