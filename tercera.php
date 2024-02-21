<?php
session_start()
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galería de Imágenes</title>
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

<div class="container">
  <h1 class="text-center mt-5 mb-4">Galería de coches</h1>
  
  <div class="row">
    <div class="col-md-4">
      <div class="card mb-4">
        <img src="./img/A3.jpg" class="card-img-top" alt="Imagen 1">
        <div class="card-body">
          <p class="card-text">Audi A3</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4">
        <img src="./img/gulietta.jpg" class="card-img-top" alt="Imagen 2">
        <div class="card-body">
          <p class="card-text">Alfa Romeo Gulietta</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4">
        <img src="./img/golf.jpeg" class="card-img-top" alt="Imagen 3">
        <div class="card-body">
          <p class="card-text">Volswagen Golf</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4">
        <img src="./img/S1.jpg" class="card-img-top" alt="Imagen 1">
        <div class="card-body">
          <p class="card-text">BMW Serie 1</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4">
        <img src="./img/corsa.jpg" class="card-img-top" alt="Imagen 2">
        <div class="card-body">
          <p class="card-text">Opel Corsa</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card mb-4">
        <img src="./img/yaris.jpg" class="card-img-top" alt="Imagen 3">
        <div class="card-body">
          <p class="card-text">Toyota Yaris GR</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
        function cerrarSesion() {
    if (confirm("¿Estás seguro de que quieres cerrar sesión?")) {
        
        window.location.href = "tiempo_sesion.php";
        session_unset();
        session_destroy();
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
