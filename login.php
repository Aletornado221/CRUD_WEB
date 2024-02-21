<?php
session_start();

// Función para conectar a la base de datos
include 'conexion.php'; // Reemplaza 'nombre_del_archivo.php' con el nombre real de tu archivo


// Verificar si se ha enviado el formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar el captcha
    if ($_POST["captcha"] != $_SESSION["captcha"]) {
        $error = "Captcha incorrecto";
    } else {
        // Recoger y limpiar los datos del formulario
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        // Validar los datos (aquí puedes agregar más validaciones según tus requisitos)
        if (empty($username) || empty($password)) {
            $error = "Por favor, introduce un username y una contraseña";
        } else {
            // Conectar a la base de datos
            $conexion = conectarBaseDatos();

            // Consulta SQL para obtener el usuario con el username proporcionado
            $sql = "SELECT * FROM USUARIO WHERE username = '$username'";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows == 1) {
                $usuario = $resultado->fetch_assoc();
                // Verificar la contraseña
                if ($password == $usuario["password"]) {
                    // Iniciar sesión y redirigir a la página de inicio
                    $_SESSION["username"] = $username;
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Contraseña incorrecta";
                }
            } else {
                $error = "Usuario no encontrado";
            }

            // Cerrar la conexión
            $conexion->close();
        }
    }
    
    // Contador de intentos de inicio de sesión
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 1;
    } else {
        $_SESSION['login_attempts']++;
    }

    // Si se supera el límite de intentos fallidos, bloquear el acceso
    if ($_SESSION['login_attempts'] >= 3) {
        $error = "Demasiados intentos fallidos. Por favor, inténtalo de nuevo más tarde.";
        // Aquí puedes agregar alguna lógica adicional, como bloquear la cuenta o enviar un correo electrónico de notificación.
    }
}


// Generar un captcha
$captcha = rand(1000, 9999);
$_SESSION["captcha"] = $captcha;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Incluir estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Login</h5>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="captcha">Captcha:</label><br>
                                <input type="text" class="form-control" id="captcha" name="captcha" required>
                                <small>Captcha: <?php echo $captcha; ?></small>
                            </div>
                            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir scripts de Bootstrap (jQuery y Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <!-- Incluir script de Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
