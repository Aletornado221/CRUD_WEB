<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conexión a base de datos MySQL</title>
</head>
<body>
    
    <?php
    // Función para crear una nueva conexión a la base de datos
    function conectarBaseDatos() {
        $servername = "localhost"; // Nombre del servidor (puede variar)
        $username = "EXAMEN"; // Nombre de usuario de la base de datos
        $password = "1234"; // Contraseña de la base de datos
        $database = "CRUD_WEB"; // Nombre de la base de datos

        // Crear una conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        } 
        
        return $conn; // Devolver la conexión
    }

    // Función para cerrar la conexión a la base de datos
    function cerrarConexion($conn) {
        $conn->close();
    }

    
    ?>
</body>
</html>
