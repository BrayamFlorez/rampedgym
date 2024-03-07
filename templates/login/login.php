<?php
session_start();

// Verificar si ya hay una sesión iniciada
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../dashboard/welcome.php");
    exit;
}

require_once "../../resources/config.php";

// Definir variables e inicializar con valores vacíos
$usuario = $contraseña = "";
$usuario_err = $contraseña_err = "";
$login_err = "";

// Procesar datos del formulario cuando se envíe el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validar nombre de usuario
    if(empty(trim($_POST["usuario"]))){
        $usuario_err = "Por favor, ingresa tu nombre de usuario.";
    } else{
        $usuario = trim($_POST["usuario"]);
    }

    // Validar contraseña
    if(empty(trim($_POST["contraseña"]))){
        $contraseña_err = "Por favor, ingresa tu contraseña.";
    } else{
        $contraseña = trim($_POST["contraseña"]);
    }

    // Verificar credenciales
    if(empty($usuario_err) && empty($contraseña_err)){
        $sql = "SELECT id, usuario, contraseña FROM usuarios WHERE usuario = ?";

        if($stmt = $conexion->prepare($sql)){
            $stmt->bind_param("s", $param_usuario);
            $param_usuario = $usuario;

            if($stmt->execute()){
                $stmt->store_result();

                // Verificar si el usuario existe
                if($stmt->num_rows == 1){
                    $stmt->bind_result($id, $usuario, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($contraseña, $hashed_password)){
                            // Contraseña correcta, iniciar sesión
                            session_start();

                            // Almacenar datos en variables de sesión
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["usuario"] = $usuario;

                            // Redireccionar al usuario a la página de bienvenida
                            header("location: ../dashboard/welcome.php");
                        } else{
                            // Mostrar mensaje de error si la contraseña no es válida
                            $login_err = "La contraseña que has ingresado no es válida.";
                        }
                    }
                } else{
                    // Mostrar mensaje de error si el usuario no existe
                    $login_err = "No se encontró ninguna cuenta con ese nombre de usuario.";
                }
            } else{
                echo "Oops! Algo salió mal. Por favor, inténtalo de nuevo más tarde.";
            }
            $stmt->close();
        }
    }

    // Cerrar conexión
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .login-container {
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
        .form-group .error {
            color: red;
        }
        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }
        .btn-login {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-login:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        // Función para mostrar alertas de error
        function showErrorAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>">
                <span class="error"><?php echo $usuario_err; ?></span>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña</label>
                <input type="password" name="contraseña" id="contraseña">
                <span class="error"><?php echo $contraseña_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn-login">Iniciar sesión</button>
            </div>            
            <div class="error-message"><?php echo $login_err; ?></div>
        </form>
        <div class="form-group">
                <a href="../check/check.php" class="btn-login">Reportar Asistencia</a>
        </div>
    </div>
    <?php
    // Mostrar alertas de error si es necesario
    if(!empty($usuario_err) || !empty($contraseña_err) || !empty($login_err)) {
        echo "<script>showErrorAlert('Por favor, corrige los errores e intenta de nuevo.');</script>";
    }
    ?>
</body>
</html>
