<?php
require_once "../../resources/config.php";
require_once "../generalFunctions/fechaHora.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clienteId = $_POST['clienteId'];

    try {
        // Verificar si ya existe un registro de asistencia para este cliente y la fecha actual
        $sql = "SELECT cliente_id FROM asistencia WHERE cliente_id = $clienteId AND DATE(fecha) = CURDATE()";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows == 0) {
            // No existe un registro de asistencia, insertar uno nuevo
            $sqlInsert = "INSERT INTO asistencia (cliente_id, fecha) VALUES ($clienteId, '$fechaHoraActual')";
            if ($conexion->query($sqlInsert) === TRUE) {
                echo '<script>window.history.back();</script>';
                exit; // Detener la ejecución del resto del script
            } else {
                echo '<script>alert("Id no encontrado verifica nuevamente ");</script>';
                echo '<script>window.history.back();</script>';
                exit; // Detener la ejecución del resto del script
            }
        } else {
            // Ya existe un registro de asistencia para este cliente y la fecha actual
            echo '<script>alert("Ya se ha marcado la asistencia para este cliente hoy");</script>';
                echo '<script>window.history.back();</script>';
                exit; // Detener la ejecución del resto del script
        }
    } catch (Exception $e) {
        // Capturar la excepción y mostrar un mensaje de alerta en la vista
        echo '<script>alert("Error al marcar la asistencia: ' . $e->getMessage() . '");</script>';
    }
}
?>
