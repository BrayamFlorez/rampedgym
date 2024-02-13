<?php
// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../../resources/config.php";

    // Obtener datos del formulario
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];

    // Validar los datos (puedes agregar más validaciones aquí según tus necesidades)

    // Cifrar la contraseña
    $contraseña_cifrada = password_hash($contraseña, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (usuario, contraseña) VALUES (?, ?)";
    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("ss", $usuario, $contraseña_cifrada);
        if ($stmt->execute()) {
            // Usuario registrado exitosamente
            $registro_exitoso = true;
        } else {
            // Error al registrar el usuario
            $registro_exitoso = false;
        }
        $stmt->close();
    }
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .registro-container {
            width: 300px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }
        .btn-registrar {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-registrar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="registro-container">
        <h2>Registro de usuario</h2>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <?php if ($registro_exitoso): ?>
                <div style="color: green;">¡Registro exitoso! Puedes iniciar sesión <a href="login.php">aquí</a>.</div>
            <?php else: ?>
                <div style="color: red;">Error al registrar el usuario. Por favor, inténtalo de nuevo.</div>
            <?php endif; ?>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-registrar">Registrar</button>
            </div>
        </form>
    </div>
</body>
</html>
