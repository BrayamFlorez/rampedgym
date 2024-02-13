<?php

// Datos de conexión a la base de datos
$host = "localhost"; // Por lo general, es "localhost"
$usuario = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$base_de_datos = "ramped"; // Nombre de la base de datos

// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $password, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}
