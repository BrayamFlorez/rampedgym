<?php
require_once "../../resources/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $clienteId = $_POST['id'];
    $nuevosDias = $_POST['diasMembresia'];

    $sql = "UPDATE clientes SET diasMembresia = '$nuevosDias' WHERE id = $clienteId";
    if ($conexion->query($sql) === TRUE) {
        echo "Días de membresía actualizados correctamente.";
    } else {
        echo "Error al actualizar los días de membresía: " . $conexion->error;
    }
}
?>
