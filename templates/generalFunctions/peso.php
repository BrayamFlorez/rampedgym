<?php
function registrarPeso($conexion, $peso) {
    // Consulta SQL
    $sql = "SELECT `nombre`, `apellido` FROM `clientes` WHERE `id` = $clienteId";

    // Ejecutar la consulta
    $resultado = $conexion->query($sql);

    // Verificar si la consulta fue exitosa
    if ($resultado !== false && $resultado->num_rows > 0) {
        // Obtener el registro consultado
        $cliente = $resultado->fetch_assoc();

        // Construir el string con el nombre y apellido del cliente
        $nombre = $cliente['nombre'] . ' ' . $cliente['apellido'];
                
        // Retornar el string con el nombre y apellido del cliente
        return $nombre;
    } else {
        // Si la consulta falla o no devuelve resultados, retornar un mensaje de error
        $nombre="no encontrado";
        return $nombre;
    }
}
?>