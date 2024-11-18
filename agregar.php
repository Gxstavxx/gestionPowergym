<?php
// Conexión a la base de datos
$conn = new mysqli('localHost', 'root', '', 'agua');

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener registros de productos
$result = $conn->query("SELECT * FROM productos");
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
        
        <center>
            <h2 class="mb-4">Gestión de Productos</h2>
        </center>

        <!-- Icono de regresar -->
        <a href="javascript:history.back()" class="btn btn-secondary mb-3" title="Regresar">
            <i class="fas fa-arrow-left"></i>
        </a>
        
        <!-- Botón de agregar producto -->
        <a href="proform.php" class="btn btn-success mb-3">Deseas Agregar Producto</a>

        <!-- Icono de casita -->
        <a href="index.php" class="btn btn-secondary mb-3" title="Inicio">
            <i class="fas fa-home"></i>
        </a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>     
                    <th>Cantidad Existente</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nombre_de_producto'] ?></td>
                    <td><?= $row['precio'] ?></td>
                    <td><?= $row['canti_stock'] ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= $row['fecha'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
