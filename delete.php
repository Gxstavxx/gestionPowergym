<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica si se ha enviado el formulario de eliminación
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $contraseña = $_POST['contraseña'];

        // Verifica la contraseña
        if ($contraseña !== '38331665') {
            echo "<div class='error-message'>Contraseña incorrecta. No se puede eliminar el producto.</div>";
        } else {
            // Consulta para eliminar el producto
            $sql = "DELETE FROM productos WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                header("Location: agregar.php"); // Redirige de nuevo a la página principal
                exit();
            } else {
                echo "<div class='error-message'>Error al eliminar el producto: " . $conn->error . "</div>";
            }

            $stmt->close();
            $conn->close();
        }
    }
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
    <title>Eliminar Producto</title>
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
            background-color: #d9534f;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #c9302c;
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
        <h2>Eliminar Producto</h2>
        <form action="" method="post">
            <label for="contraseña">Contraseña para confirmar:</label>
            <input type="password" id="contraseña" name="contraseña" required>

            <input type="submit" value="Eliminar Producto">
        </form>
    </div>
</body>
</html>
