<?php
require_once "../../resources/config.php";

function obtenerDatosCliente($idCliente){
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['idCliente'])) {
    $idCliente = $_GET['idCliente'];
    echo $idCliente;

    // Consultar los datos del cliente con el ID especificado
    $sql = "SELECT * FROM clientes WHERE id = $idCliente";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        // El cliente fue encontrado, obtener los datos
        $cliente = $resultado->fetch_assoc();

        // Guardar los campos del cliente en variables
        $id = $cliente['id'];
        $nombre = $cliente['nombre'];
        $apellido = $cliente['apellido'];
        $email = $cliente['email'];
        echo $nombre;
        // Agrega más campos según sea necesario

    } else {
        // El cliente no fue encontrado
        echo "Cliente no encontrado.";
    }
} else {
    // No se proporcionó un ID de cliente válido
    echo "Por favor, proporcione un ID de cliente válido.";
}
}


?>
