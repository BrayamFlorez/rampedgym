<?php 
require_once "../../resources/config.php";

function contarAsistenciasPorDia($conexion, $diasHaciaAtras) {
    date_default_timezone_set("America/Bogota");
    $fechas = array();
    $asistenciasPorDia = array();

    for ($i = 0; $i < $diasHaciaAtras; $i++) {
        $fecha = date('Y-m-d', strtotime("-$i days"));
        $fechas[] = $fecha;
        $asistenciasPorDia[$fecha] = 0; // Inicializar a cero las asistencias para este día
    }

    $sql = "SELECT COUNT(*) as total, DATE(fecha) as fecha FROM asistencia WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL $diasHaciaAtras DAY) GROUP BY DATE(fecha)";

    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $fecha = date('Y-m-d', strtotime($row["fecha"]));
            $asistenciasPorDia[$fecha] = $row["total"];
        }
    }

    return $asistenciasPorDia;
}

function contarAsistencias($conexion) {
    date_default_timezone_set('UTC');
    date_default_timezone_set("America/Bogota");
    $fechaActual = date('Y-m-d 00:00:00');
    $sql = "SELECT COUNT(*) as total FROM asistencia WHERE fecha > '$fechaActual'";
    $resultado = $conexion->query($sql);
    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        return $row["total"];
    } else {
        return 0;
    }
}


//temporal mientras se eliminan permisos de consulta a los clientes
function obtenerClientesNoNotificados() {
    $clientes = array();
    return $clientes;
}

function obtenerClientePorId($conexion, $clienteId) {
    $sql = "SELECT nombre, apellido FROM clientes WHERE id = $clienteId";
    $resultado = $conexion->query($sql); 
    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();        
        return $row["nombre"] . " " . $row["apellido"];
    } else {
        return null;
    }
}

// Ejemplo de uso: obtener el número de asistencias de los últimos 7 días
$asistenciasPorDia = contarAsistenciasPorDia($conexion, 7);
$totalAsistenciasNotify = 0;
?>