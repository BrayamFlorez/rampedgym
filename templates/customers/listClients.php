<?php

function mostrarClientes($conexion, $busqueda = null) {
    // Consultar todos los clientes o filtrar por búsqueda
    $sql = "SELECT * FROM clientes";
    if ($busqueda) {
        $sql .= " WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%' OR email LIKE '%$busqueda%' OR telefono LIKE '%$busqueda%' OR fecha_inicio_membresia LIKE '%$busqueda%'";
    }
    $resultado = $conexion->query($sql);

    

    // Mostrar los clientes en la tabla
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            // Calcular la diferencia en meses entre la fecha actual y la fecha de inicio de membresía
            $fecha_inicio = new DateTime($row["fecha_inicio_membresia"]);
            $fecha_actual = new DateTime();
            $diferencia_dias = $fecha_inicio->diff($fecha_actual)->days;
            $dias_membresia = $row["diasMembresia"];
            $fecha_vencimiento = $fecha_inicio->modify("+$dias_membresia days");

            // Determinar el estado de la membresía
            $estado = ($fecha_vencimiento < $fecha_actual) ? 'Vencido' : 'Activo';

            // Aplicar estilos CSS condicionales según la diferencia en meses
            $color = '';
            $estilo = '';
            if ($estado == "Vencido") {
                $color = 'orange'; // naranja para más de un mes
                $estilo = 'font-weight: bold;'; // texto en negrita
            } else {
                $color = '#0d6efd'; // azul claro para menos de un mes
                $estilo = 'font-weight: bold;'; // texto en negrita
            }

            // Mostrar el cliente en la tabla con los estilos CSS aplicados
            echo "<tr>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["apellido"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            echo "<td>" . $row["fecha_inicio_membresia"] . "</td>";
            echo "<td>" . $row["diasMembresia"] . "</td>";
            echo "<td>" . $fecha_vencimiento->format('Y-m-d') . "</td>"; // Mostrar la fecha de vencimiento
            echo "<td style='color: $color; $estilo'>" . $estado . "</td>";
            echo "<td class='acciones'><a href='deleteClients.php?id=" . $row["id"] . "'><i class='fas fa-trash-alt'></i> Borrar</a> | <a href='renovarMembresia.php?id=" . $row["id"] . "'><i class='fas fa-sync-alt'></i> Renovar</a></td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No se encontraron clientes</td></tr>";
    }
}

?>
