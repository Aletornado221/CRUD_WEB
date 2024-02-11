<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <!-- Incluir estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Registro de Usuario</h5>
                    </div>
                    <div class="card-body">
                        

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

            echo "<p>Registro exitoso</p>";
        } else {
            // Mostrar errores de validación
            echo "<p>Error: $error</p>";
        }
    }
    ?>


                        <!-- Formulario de registro -->
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="sexo">Sexo:</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo_masculino" value="Masculino" required>
                                    <label class="form-check-label" for="sexo_masculino">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo_femenino" value="Femenino">
                                    <label class="form-check-label" for="sexo_femenino">Femenino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo_otro" value="Otro">
                                    <label class="form-check-label" for="sexo_otro">Otro</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrarse</button>
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
