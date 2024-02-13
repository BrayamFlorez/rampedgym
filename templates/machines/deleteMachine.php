<?php
require_once "../../resources/config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM inventario_maquinas WHERE id=$id";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Máquina eliminada correctamente'); window.location.href='machines.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar la máquina: " . $conexion->error . "'); window.location.href='machines.php';</script>";
    }
}

$conexion->close();
?>
