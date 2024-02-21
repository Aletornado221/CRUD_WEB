<?php


session_start();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <!-- Incluir estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">EsMotor</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item" >
                        <a class="nav-link" href="about.php">Acerca de</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php if (!isset($_SESSION["username"])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="registro.php">Registro</a>
                        </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION["username"])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="registro.php"><?php echo $_SESSION["username"]; ?></a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="#" onclick="cerrarSesion()">Cerrar Sesión</a>

                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Iniciar Sesión</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">Página de Inicio</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <?php if (isset($_SESSION["username"])) : ?>
                                <a href="tercera.php" class="btn btn-primary">Tercera</a>
                            <?php endif; ?>
                        </div>
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

    <script>
        
function cerrarSesion() {
    if (confirm("¿Estás seguro de que quieres cerrar sesión?")) {
        
        window.location.href = "tiempo_sesion.php";
    }
}








// Establecer el tiempo de inactividad en milisegundos (10 minutos en este caso)
var tiempoDeInactividad = 10* 1000; // 10 minutos

// Variable para almacenar el temporizador
var temporizadorDeInactividad;

// Función para reiniciar el temporizador de inactividad
function reiniciarTemporizadorDeInactividad() {
    clearTimeout(temporizadorDeInactividad);
    temporizadorDeInactividad = setTimeout(ejecutarArchivoPHP, tiempoDeInactividad);
}

// Función para ejecutar el archivo PHP

function ejecutarArchivoPHP() {
   
    <?php if (isset($_SESSION["username"])) : ?>

        window.location.href = "tiempo_sesion.php";


    <?php endif; ?>

}

// Evento para detectar la actividad del usuario (cualquier interacción)
document.addEventListener('mousemove', reiniciarTemporizadorDeInactividad);
document.addEventListener('keypress', reiniciarTemporizadorDeInactividad);
    
    reiniciarTemporizadorDeInactividad();




    </script>
</body>

</html>