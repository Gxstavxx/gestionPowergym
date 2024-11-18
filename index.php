<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'agua');

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Enlace a la CDN de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Título principal centrado -->
        <div class="text-center mb-4">
            <h2>Gestión de Productos</h2>
        </div>

        <!-- Contenedor para los botones -->
        <div class="d-flex justify-content-center gap-4">
            <a href="agregar.php" class="btn btn-success btn-lg" title="Agregar Producto">
                <i class="fas fa-plus-circle me-2"></i> Agregar Producto
            </a>
            <a href="ventas.php" class="btn btn-info btn-lg" title="Ventas">
                <i class="fas fa-chart-line me-2"></i> Ventas
            </a>
            <a href="total.php" class="btn btn-warning btn-lg" title="Total">
                <i class="fas fa-dollar-sign me-2"></i> Total
            </a>
        </div>
    </div>

    <!-- Enlace a la CDN de Bootstrap JS (opcional para interacciones) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
