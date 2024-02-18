

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar Sesión</title>
    <!-- Incluir estilos de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<script>
        function cerrar() {
            window.location.href = 'cierre_sesion.php';
        }
    </script>



    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h5 class="card-title mb-0">Cerrar Sesión</h5>
                    </div>
                    <div class="card-body text-center">
                        <p>La sesion ha sido cerrada</p>
                        <a href="index.php" class="btn btn-primary" onclick="cerrar()" >Volver al Inicio</a>
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
