<?php
require_once "../../resources/config.php";

// Verificar si se recibió un ID de cliente válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $clienteId = $_GET['id'];

    // Obtener la fecha actual
    $fecha_actual = date('Y-m-d');

    // Actualizar la fecha de inicio de membresía del cliente
    $sql = "UPDATE clientes SET fecha_inicio_membresia = '$fecha_actual' WHERE id = $clienteId";
    if ($conexion->query($sql) === TRUE) {
        echo "La membresía se ha renovado correctamente.";
    } else {
        echo "Error al renovar la membresía: " . $conexion->error;
    }
} else {
    echo "ID de cliente inválido.";
}

// Redireccionar a la página de clientes después de renovar la membresía
header("Location: clients.php");
exit;
?>