<?php
date_default_timezone_set('America/Bogota'); // Establecer la zona horaria de Colombia

$fecha_actual = new DateTime();
echo $fecha_actual->format('Y-m-d H:i:s'); // Mostrar la fecha actual en formato 'YYYY-MM-DD HH:MM:SS'
?>