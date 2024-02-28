<?php
require_once "../../resources/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clienteId = $_POST['clienteId'];
    $fechaActual = date("Y-m-d");

    // Verificar si ya existe un registro de asistencia para este cliente y la fecha actual
    $sql = "SELECT * FROM asistencia WHERE cliente_id = $clienteId AND fecha = '$fechaActual'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 0) {
        // No existe un registro de asistencia, insertar uno nuevo
        $sqlInsert = "INSERT INTO asistencia (cliente_id, fecha) VALUES ($clienteId, '$fechaActual')";
        if ($conexion->query($sqlInsert) === TRUE) {
        } else {
            echo "Error al marcar la asistencia: " . $conexion->error;
        }
    } else {
        // Ya existe un registro de asistencia para este cliente y la fecha actual
        echo "Ya se ha marcado la asistencia para este cliente hoy.";
    }
}
?>
