<?php
// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'agua');

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los productos junto con la información de las ventas
$query = "
    SELECT 
        p.id AS producto_id, 
        p.nombre_de_producto, 
        p.canti_stock, 
        SUM(v.vendidos) AS total_vendidos, 
        (p.canti_stock - SUM(v.vendidos)) AS total_cantidad, 
        SUM(v.total) AS total_ventas
    FROM productos p
    LEFT JOIN ventas v ON p.nombre_de_producto = v.fknombre_de_producto
    GROUP BY p.id, p.nombre_de_producto, p.canti_stock
";

// Ejecutar la consulta
$result = $conn->query($query);
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

        <!-- Botones de regresar y casita -->
        <div class="mb-3">
            <a href="javascript:history.back()" class="btn btn-secondary" title="Regresar">
                <i class="fas fa-arrow-left"></i>
            </a>
            <a href="index.php" class="btn btn-secondary" title="Inicio">
                <i class="fas fa-home"></i>
            </a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad Existente</th>    
                    <th>Vendidos</th>
                    <th>Total Cantidad</th>
                    <th>Total $</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['producto_id'] ?></td>
                    <td><?= $row['nombre_de_producto'] ?></td>
                    <td><?= $row['canti_stock'] ?></td>
                    <td><?= $row['total_vendidos'] ?></td>
                    <td><?= $row['total_cantidad'] ?></td>
                    <td><?= $row['total_ventas'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
