<?php
require_once "../../resources/config.php";

    $sql = "UPDATE asistencia SET notificado = 1 WHERE notificado = 0";
    $resultado = $conexion->query($sql);
    if ($resultado) {
        echo "Notificaciones marcadas correctamente.";
    } else {
        echo "Error al marcar las notificaciones: " . $conexion->error;
    }

?>
