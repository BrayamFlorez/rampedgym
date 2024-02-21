<?php

function mostrarAsistenciaIcono($conexion, $clienteId) {
    $fecha_actual = date("Y-m-d");
    $sql = "SELECT * FROM asistencia WHERE cliente_id = $clienteId AND fecha = '$fecha_actual'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        return "<i class='fas fa-check-circle' style='color: green;'></i>";
    } else {
        return "<i class='far fa-check-circle' style='color: gray; cursor: pointer;' onclick='marcarAsistencia($clienteId); location.reload();'></i>";
    }
}


function mostrarClientes($conexion, $busqueda = null) {
    // Consultar todos los clientes o filtrar por búsqueda
    $sql = "SELECT * FROM clientes";
    if ($busqueda) {
        $sql .= " WHERE nombre LIKE '%$busqueda%' OR apellido LIKE '%$busqueda%'  OR telefono LIKE '%$busqueda%' OR fecha_inicio_membresia LIKE '%$busqueda%'";
    }
    $resultado = $conexion->query($sql);

    // Mostrar los clientes en la tabla
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            // Calcular la diferencia en días entre la fecha actual y la fecha de inicio de membresía
            date_default_timezone_set('America/Bogota');
            $fecha_inicio = new DateTime($row["fecha_inicio_membresia"]);
            $fecha_actual = new DateTime();
            $diferencia = $fecha_inicio->diff($fecha_actual);
            $diferencia_dias = $diferencia->days;

            $dias_membresia = $row["diasMembresia"];
            $fecha_vencimiento = $fecha_inicio->modify("+{$dias_membresia} days")->modify("-1 day");

            // Determinar el estado de la membresía
            $estado = ($fecha_vencimiento < $fecha_actual) ? 'Vencido' : 'Activo';

            // Aplicar estilos CSS condicionales según el estado de la membresía
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
            echo "<td>" . mostrarAsistenciaIcono($conexion, $row["id"]) . "</td>";
            echo "<td style='color: $color; $estilo'>" . $row["nombre"] . "</td>";
            echo "<td style='color: $color; $estilo'>" . $row["apellido"] . "</td>";
            echo "<td>" . $row["telefono"] . "</td>";
            echo "<td id='fechaInicioMembresia" . $row["id"] . "'>" . $row["fecha_inicio_membresia"] . " <a title='Renovar fecha de inicio' class='fas fa-sync-alt' style='cursor: pointer;' onclick='editarFechaInicioMembresia(" . $row["id"] . ")'></a></td>";
            echo "<td id='diasMembresia" . $row["id"] . "'>" . $row["diasMembresia"] . " <a title='Renovar dias de membresia' class='fas fa-sync-alt' style='cursor: pointer;' onclick='editarDiasMembresia(" . $row["id"] . ")'></a></td>";
            echo "<td style='color: $color; $estilo'>" . $fecha_vencimiento->format('Y-m-d') . "</td>"; // Mostrar la fecha de vencimiento
            echo "<td class='acciones'><a href='deleteClients.php?id=" . $row["id"] . "'><i class='fas fa-trash-alt' title='Borrar'></i></a> | <a href='renovarMembresia.php?id=" . $row["id"] . "'><i class='fas fa-sync-alt' title='Renovar con datos actuales'></i></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No se encontraron clientes</td></tr>";
    }
}

?>

<script>
function editarDiasMembresia(idCliente) {
    var nuevosDias = prompt("Ingrese los nuevos días de membresía:");
    if (nuevosDias && /^\d+$/.test(nuevosDias)) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "actualizarDiasMembresia.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    // Actualizar el valor en la tabla sin recargar la página
                    document.getElementById("diasMembresia" + idCliente).innerText = nuevosDias;
                    alert("Cambio exitoso");
                    location.reload();
                } else {
                    alert("Error al realizar el cambio");
                }
            }
        };
        xhr.send("id=" + idCliente + "&diasMembresia=" + nuevosDias);
    } else {
        alert("Por favor ingrese solo números para los días de membresía.");
    }
}
</script>

<script>
function editarFechaInicioMembresia(idCliente) {
    var nuevaFechaInicio = prompt("Ingrese la nueva fecha de inicio de membresía (AAAA-MM-DD):");
    if (nuevaFechaInicio) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "actualizarFechaInicioMembresia.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Actualizar el valor en la tabla sin recargar la página
                document.getElementById("fechaInicioMembresia" + idCliente).innerText = nuevaFechaInicio;
            }
        };
        xhr.send("id=" + idCliente + "&fechaInicioMembresia=" + nuevaFechaInicio);
    }
}
</script>

<script>
function marcarAsistencia(clienteId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "marcarAsistencia.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Cambiar el icono a un check marcado después de marcar la asistencia
            document.getElementById("asistenciaIcon" + clienteId).innerHTML = "<i class='fas fa-check-circle'></i>";
        }
    };
    xhr.send("clienteId=" + clienteId);
}
</script>