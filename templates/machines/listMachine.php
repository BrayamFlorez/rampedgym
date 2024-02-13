<?php
function mostrarMaquinas($conexion) {
    // Consultar todas las máquinas
    $sql = "SELECT * FROM inventario_maquinas";
    $resultado = $conexion->query($sql);

    // Mostrar las máquinas en la tabla
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["marca"] . "</td>";
            echo "<td>" . $row["modelo"] . "</td>";
            echo "<td>" . $row["estado"] . "</td>";
            echo "<td>" . $row["fecha_adquisicion"] . "</td>";
            echo "<td>" . $row["precio_adquisicion"] . "</td>";
            echo "<td>" . $row["ubicacion"] . "</td>";
            echo "<td><a href='deleteMachine.php?id=" . $row["id"] . "'><i class='fas fa-trash-alt'></i></a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No hay máquinas registradas</td></tr>";
    }
}


?>
