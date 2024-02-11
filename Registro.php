<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    
    <?php
    include 'conexion.php'; // Reemplaza 'nombre_del_archivo.php' con el nombre real de tu archivo
    // Función para validar los datos del formulario
    function validarDatos($nombre, $username, $password, $sexo, $fechaNacimiento) {
        // Validar el nombre
        if (!preg_match("/^[a-zA-Z]{10,}$/", $nombre)) {
            return "El nombre debe tener al menos 10 caracteres alfabéticos.";
        }

        // Validar el username
        if (!preg_match("/^[a-zA-Z][a-zA-Z0-9]{7,}$/", $username)) {
            return "El username debe tener al menos 8 caracteres alfanuméricos y empezar con una letra.";
        }

        // Validar la contraseña
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password)) {
            return "La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un número.";
        }

        // Validar la fecha de nacimiento
        $fechaActual = new DateTime();
        $fechaNacimiento = new DateTime($fechaNacimiento);
        $edad = $fechaActual->diff($fechaNacimiento)->y;
        if ($edad < 16) {
            return "Debes tener al menos 16 años para registrarte.";
        }

        return ""; // Si pasa todas las validaciones
    }

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recoger y limpiar los datos del formulario
        $nombre = htmlspecialchars($_POST["nombre"]);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $sexo = htmlspecialchars($_POST["sexo"]);
        $fechaNacimiento = htmlspecialchars($_POST["fechaNacimiento"]);

        // Validar los datos
        $error = validarDatos($nombre, $username, $password, $sexo, $fechaNacimiento);

        if (empty($error)) {
            // Si no hay errores, guardar en la base de datos
            $conexion = conectarBaseDatos();
            $stmt = $conexion->prepare("INSERT INTO USUARIO (nombre, username, password, sexo, fechaNacimiento) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $nombre, $username, $password, $sexo, $fechaNacimiento);
            $stmt->execute();
            cerrarConexion($conexion);

            echo "<p>Registro exitoso</p>";
        } else {
            // Mostrar errores de validación
            echo "<p>Error: $error</p>";
        }
    }
    ?>

    <!-- Formulario de registro -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Nombre: <input type="text" name="nombre" required><br>
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        Sexo:
        <input type="radio" name="sexo" value="Masculino" required> Masculino
        <input type="radio" name="sexo" value="Femenino"> Femenino
        <input type="radio" name="sexo" value="Otro"> Otro<br>
        Fecha de Nacimiento: <input type="date" name="fechaNacimiento" required><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
