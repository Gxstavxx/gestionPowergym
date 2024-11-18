<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

// Verifica si se pasó un ID para editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Consulta para obtener los datos del producto
    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $producto = $result->fetch_assoc();

    if (!$producto) {
        echo "<div class='error-message'>Producto no encontrado.</div>";
        exit();
    }
    
    // Verifica si se ha enviado el formulario de edición
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre_de_producto = $_POST['nombre_de_producto'];
        $precio = $_POST['precio'];
        $canti_stock = $_POST['canti_stock'];
        $fecha = $_POST['fecha'];
        $contraseña = $_POST['contraseña'];

        // Verifica la contraseña
        if ($contraseña !== '38331665') {
            echo "<div class='error-message'>Contraseña incorrecta. No se puede editar el producto.</div>";
        } else {
            // Calcula el nuevo total
            $total = $precio * $canti_stock;

            // Actualiza los datos del producto en la base de datos
            $updateSql = "UPDATE productos SET nombre_de_producto = ?, precio = ?, canti_stock = ?, total = ?, fecha = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("siiisi", $nombre_de_producto, $precio, $canti_stock, $total, $fecha, $id);

            if ($updateStmt->execute()) {
                header("Location: agregar.php"); // Redirige de nuevo a la página principal
                exit();
            } else {
                echo "<div class='error-message'>Error al actualizar el producto: " . $conn->error . "</div>";
            }

            $updateStmt->close();
        }
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "<div class='error-message'>ID de producto no especificado.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Editar Producto</h2>
        <form action="" method="post">
            <label for="nombre_de_producto">Nombre del Producto:</label>
            <input type="text" id="nombre_de_producto" name="nombre_de_producto" value="<?= htmlspecialchars($producto['nombre_de_producto']) ?>" required>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>" required>

            <label for="canti_stock">Cantidad en Stock:</label>
            <input type="number" id="canti_stock" name="canti_stock" value="<?= htmlspecialchars($producto['canti_stock']) ?>" required>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?= htmlspecialchars($producto['fecha']) ?>" required>

            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>

            <input type="submit" value="Actualizar Producto">
        </form>
    </div>
</body>
</html>
