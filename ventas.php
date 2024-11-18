<?php
// Conexión a la base de datos
$conn = new mysqli('localHost', 'root', '', 'agua');

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los productos para el desplegable de productos
$productosResult = $conn->query("SELECT DISTINCT fknombre_de_producto FROM ventas");

// Variables para los filtros
$productoFiltro = isset($_GET['producto']) ? $_GET['producto'] : '';
$fechaFiltro = isset($_GET['fecha']) ? $_GET['fecha'] : date('Y-m-d');  // Fecha por defecto es hoy

// Construir la consulta SQL con los filtros
$sql = "SELECT * FROM ventas WHERE fechaventa = '$fechaFiltro'";

if ($productoFiltro) {
    $sql .= " AND fknombre_de_producto = '$productoFiltro'";
}

// Obtener registros de ventas con los filtros aplicados
$result = $conn->query($sql);
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

        <!-- Botón de agregar venta -->
        <a href="veform.php" class="btn btn-success mb-3">Deseas Agregar una Venta?</a>

        <!-- Icono de casita -->
        <a href="index.php" class="btn btn-secondary mb-3" title="Inicio">
            <i class="fas fa-home"></i>
        </a>

        <!-- Filtros con autoenvío -->
        <form action="" method="GET" class="mb-4">
            <div class="row">
                <!-- Filtro por Producto -->
                <div class="col-md-6">
                    <label for="producto" class="form-label">Seleccionar Producto</label>
                    <select id="producto" name="producto" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Selecciona un producto --</option>
                        <?php while ($producto = $productosResult->fetch_assoc()): ?>
                            <option value="<?= $producto['fknombre_de_producto'] ?>" <?= ($producto['fknombre_de_producto'] == $productoFiltro) ? 'selected' : '' ?>><?= $producto['fknombre_de_producto'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- Filtro por Fecha -->
                <div class="col-md-6">
                    <label for="fecha" class="form-label">Seleccionar Fecha</label>
                    <input type="date" id="fecha" name="fecha" class="form-control" value="<?= $fechaFiltro ?>" onchange="this.form.submit()" />
                </div>
            </div>
        </form>

        <!-- Tabla de Ventas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>     
                    <th>Vendidos</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['fknombre_de_producto'] ?></td>
                    <td><?= $row['fk_precio'] ?></td>
                    <td><?= $row['vendidos'] ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= $row['fechaventa'] ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
