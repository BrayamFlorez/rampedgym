<?php
require_once "../../resources/config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM clientes WHERE id=$id";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('Cliente eliminado correctamente'); window.location.href='clients.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar al Cliente: " . $conexion->error . "'); window.location.href='clients.php';</script>";
    }
}

$conexion->close();
?>
