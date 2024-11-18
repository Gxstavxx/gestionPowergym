<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Venta</title>
    <!-- Cargando la librería Font Awesome para los iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Agregar Font Awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        select,
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .success-message {
            text-align: center;
            color: green;
            margin-top: 10px;
        }

        .error-message {
            text-align: center;
            color: red;
            margin-top: 10px;
        }

        /* Estilos para los botones flotantes en la esquina */
        .btn-container {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
        }

        .btn-container a {
            text-decoration: none;
            margin-left: 10px;
        }

        .btn-container .btn {
            background-color: #6c757d; /* Gris */
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .btn-container .btn:hover {
            background-color: #5a6268; /* Gris más oscuro */
        }

        .btn-container i {
            color: white; /* Color de los iconos */
            margin-right: 8px; /* Espaciado entre icono y texto */
        }

    </style>
</head>
<body>

    <!-- Botones flotantes en la esquina superior izquierda -->
    <div class="btn-container">
        <a href="agregar.php" class="btn">
            <i class="fas fa-arrow-left"></i> 
        </a>
        <a href="index.php" class="btn">
            <i class="fas fa-home"></i> 
        </a>
    </div>

    <!-- Formulario de registrar venta -->
    <div class="form-container">
        <h2>Registrar Venta</h2>
        <form action="baseve.php" method="post">
            <!-- Selección de producto -->
            <label for="fknombre_de_producto">Producto:</label>
            <select id="fknombre_de_producto" name="fknombre_de_producto" required>
                <option value="">Selecciona un producto</option>
                <?php
                include 'conexion.php';
                $sql = "SELECT id, nombre_de_producto, precio FROM productos"; // Seleccionamos el id, nombre y precio de los productos
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['nombre_de_producto'] . "' data-precio='" . $row['precio'] . "'>" . $row['nombre_de_producto'] . "</option>";
                }
                ?>
            </select><br>

            <!-- Campo de precio (solo lectura) -->
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required readonly><br>

            <!-- Cantidad vendida -->
            <label for="vendidos">Cantidad Vendida:</label>
            <input type="number" id="vendidos" name="vendidos" required><br>

            <!-- Fecha -->
            <label for="fechaventa">Fecha:</label>
            <input type="date" id="fechaventa" name="fechaventa" required><br>

            <!-- Botón de envío -->
            <input type="submit" value="Registrar Venta">
        </form>
    </div>

    <script>
        // Script para autocompletar el precio al seleccionar el producto
        document.getElementById('fknombre_de_producto').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var precio = selectedOption.getAttribute('data-precio');
            document.getElementById('precio').value = precio;
        });

        // Script para establecer la fecha actual en el campo de fecha
        document.getElementById('fechaventa').value = new Date().toISOString().split('T')[0];
    </script>

</body>
</html>
