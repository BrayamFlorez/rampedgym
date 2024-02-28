<?php
// funciones.php

require_once "../../resources/config.php";


// Verificar si el usuario ha iniciado sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login.php");
    exit;
}

$sql = "SELECT COUNT(*) as total_clientes FROM clientes";
$resultado = $conexion->query($sql);
$total_clientes = 0;
if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $total_clientes = $row["total_clientes"];
}

// Obtener el nombre de usuario del usuario autenticado
$usuario = $_SESSION["usuario"];

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

// Obtener la fecha actual
$fecha_actual = date("Y-m-d");

// Calcular la fecha 30 días antes
$fecha_30_dias_atras = date("Y-m-d", strtotime("-30 days", strtotime($fecha_actual)));

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
    $fecha_actual = date("Y-m-d");
    $sql = "SELECT COUNT(*) as total FROM asistencia WHERE fecha = '$fecha_actual'";
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
