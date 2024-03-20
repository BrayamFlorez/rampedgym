<?php
require_once "../../resources/config.php";
require_once "../generalFunctions/fechaHora.php";

function obtenerDatosCliente($id) {
    global $conexion; // Accede a la conexión definida fuera de la función

    try {
        // Consulta SQL para obtener los datos del cliente
        $sql = "SELECT `nombre`, `apellido`, `fechaRegistro`, `fecha_inicio_membresia`, `diasMembresia` FROM `clientes` WHERE `id` = $id";
        $resultado = $conexion->query($sql);

        // Verificar si se obtuvieron resultados
        if ($resultado->num_rows > 0) {
            // Retorna los datos del cliente
            return $resultado->fetch_assoc();
        } else {
            // Si no se encontraron resultados, retorna null
            return null;
        }
    } catch (Exception $e) {
        // Captura la excepción y muestra un mensaje de error
        return null; // Retorna null en caso de error
    }
}

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
                // Si se insertó correctamente, obtener los datos del cliente
                $datosCliente = obtenerDatosCliente($clienteId);
                
                // Retorna los datos del cliente para usar en la vista
                if ($datosCliente) {
                    echo json_encode($datosCliente); // Retorna los datos del cliente como un JSON
                } else {
                    echo json_encode(["error" => "No se encontraron datos del cliente"]); // Retorna un mensaje de error
                }
            } else {
                echo json_encode(["error" => "Id no encontrado, verifica nuevamente"]); // Retorna un mensaje de error
            }
        } else {
            echo json_encode(["error" => "Ya se ha marcado la asistencia para este cliente hoy"]); // Retorna un mensaje de error
        }
    } catch (Exception $e) {
        // Capturar la excepción y mostrar un mensaje de error
        echo json_encode(["error" => "Error al marcar la asistencia: " . $e->getMessage()]); // Retorna un mensaje de error
    }
}
?>
