<?php
function mostrarClientes($conexion) {
    // Consultar todos los clientes
    $sql = "SELECT * FROM clientes";
    $resultado = $conexion->query($sql);

    // Mostrar los clientes en la tabla
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            // Calcular la diferencia en meses entre la fecha actual y la fecha de inicio de membresía
            $fecha_inicio = new DateTime($row["fecha_inicio_membresia"]);
            $fecha_actual = new DateTime();
            $diferencia_meses = $fecha_inicio->diff($fecha_actual)->m;
            $diferencia_dias = $fecha_inicio->diff($fecha_actual)->days;

            // Determinar el estado de la membresía
            $estado = ($diferencia_dias > 30) ? 'Vencido' : 'Activo';

            // Aplicar estilos CSS condicionales según la diferencia en meses
            $color = '';
            $estilo = '';
            if ($diferencia_meses > 1) {
                $color = 'orange'; // naranja para más de un mes
                $estilo = 'font-weight: bold;'; // texto en negrita
            } else {
                $color = '#0d6efd'; // azul claro para menos de un mes
                $estilo = 'font-weight: bold;'; // texto en negrita
            }

            // Mostrar el cliente en la tabla con los estilos CSS aplicados
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["apellido"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            echo "<td style='color: $color; $estilo'>" . $row["fecha_inicio_membresia"] . "</td>";
            echo "<td style='color: $color; $estilo'>" . $estado . "</td>";
            echo "<td><a href='deleteClients.php?id=" . $row["id"] . "'><i class='fas fa-trash-alt'></i></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No hay clientes registrados</td></tr>";
    }
}


?>
