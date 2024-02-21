<?php
$tiempoInactivo = 15; // 2 minutos en segundos

    // Verificar si existe una marca de tiempo de la última actividad
    if (isset($_SESSION['ultima_actividad']) && (time() - $_SESSION['ultima_actividad']) > $tiempoInactivo) {
        // Si el tiempo de inactividad es superior a 2 minutos, redirigir a cierre_sesion.php
        header("Location: tiempo_sesion.php");
        exit();
    } else {
        // Actualizar la marca de tiempo de la última actividad
        $_SESSION['ultima_actividad'] = time();
    }