<?php 
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
?>