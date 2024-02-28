<?php
require_once "../../resources/config.php";

function verificarCliente($conexion, $clienteId) {
    $sql = "SELECT * FROM clientes WHERE id = $clienteId";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        return true; // El cliente existe
    } else {
        return false; // El cliente no existe
    }
}

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se ha recibido un ID de cliente
if (isset($_GET['id'])) {
    $clienteId = $_GET['id'];

    // Verificar si el cliente existe
    if (verificarCliente($conexion, $clienteId)) {
        echo json_encode(array("exists" => true));
    } else {
        echo json_encode(array("exists" => false));
    }
}

?>
