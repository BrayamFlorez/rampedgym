<?php
// funciones.php

require_once "../../resources/config.php";
require_once "../generalFunctions/fechaHora.php";

$sql = "SELECT COUNT(*) as total_maquinas FROM inventario_maquinas";
$resultado = $conexion->query($sql);
$total_maquinas = 0;
if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $total_maquinas = $row["total_maquinas"];
}

$sql = "SELECT COUNT(*) as total_rutinas FROM rutinas";
$resultado = $conexion->query($sql);
$total_rutinas = 0;
if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $total_rutinas = $row["total_rutinas"];
}

// Calcular la fecha 30 días antes
$fecha_30_dias_atras = date("Y-m-d", strtotime("-30 days", strtotime($fechaActual)));

// Consulta SQL para contar los clientes con fecha de inicio de membresía menor a 30 días
$sql_menores_30_dias = "SELECT COUNT(*) AS total_menores_30_dias FROM clientes WHERE fecha_inicio_membresia > '$fecha_30_dias_atras'";

// Consulta SQL para contar los clientes con fecha de inicio de membresía mayor a 30 días
$sql_mayores_30_dias = "SELECT COUNT(*) AS total_mayores_30_dias FROM clientes WHERE fecha_inicio_membresia <= '$fecha_30_dias_atras'";

// Ejecutar las consultas
$resultado_menores_30_dias = $conexion->query($sql_menores_30_dias);
$resultado_mayores_30_dias = $conexion->query($sql_mayores_30_dias);

// Obtener el total de membresías activas con fecha de inicio menor a 30 días
$total_menores_30_dias = 0;
if ($resultado_menores_30_dias->num_rows > 0) {
    $row = $resultado_menores_30_dias->fetch_assoc();
    $total_menores_30_dias = $row["total_menores_30_dias"];
}

// Obtener el total de membresías activas con fecha de inicio mayor a 30 días
$total_mayores_30_dias = 0;
if ($resultado_mayores_30_dias->num_rows > 0) {
    $row = $resultado_mayores_30_dias->fetch_assoc();
    $total_mayores_30_dias = $row["total_mayores_30_dias"];
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

function contarAsistenciasNotificadas($conexion) {
    $sql = "SELECT COUNT(*) as total FROM asistencia WHERE notificado = '0'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        return $row["total"];
    } else {
        return 0;
    }
}

function obtenerClientesNoNotificados($conexion) {
    $sql = "SELECT DISTINCT cliente_id FROM asistencia WHERE notificado = 0";
    $resultado = $conexion->query($sql);

    $clientes = array();

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $clienteId = $row["cliente_id"];
            $cliente = obtenerClientePorId($conexion, $clienteId);
            if ($cliente) {
                $clientes[] = $cliente;
            }
        }
    }
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




$totalAsistenciasNotify = contarAsistenciasNotificadas($conexion);
$totalAsistencias = contarAsistencias($conexion);

  
?>
