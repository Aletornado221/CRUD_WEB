<?php
session_start();

// Destruir la sesión
session_unset();
session_destroy();
// Eliminar todas las cookies



// Redirigir al index.php después de cerrar sesión
header("Location: index.php");
exit();  

