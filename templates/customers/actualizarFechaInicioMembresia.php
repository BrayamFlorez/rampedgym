<?php
require_once "../../resources/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clienteId = $_POST['id'];
    $nuevaFechaInicio = $_POST['fechaInicioMembresia'];

    $sql = "UPDATE clientes SET fecha_inicio_membresia = '$nuevaFechaInicio' WHERE id = $clienteId";
    if ($conexion->query($sql) === TRUE) {
        echo "Fecha de inicio de membresía actualizada correctamente.";
    } else {
        echo "Error al actualizar la fecha de inicio de membresía: " . $conexion->error;
    }
}
?>
