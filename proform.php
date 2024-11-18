<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
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

        input[type="text"],
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
            color: white; /* Color de los iconos en gris */
        }

    </style>
    <!-- Enlace a la CDN de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        // Script para establecer la fecha actual en el campo de fecha
        window.onload = function() {
            const fechaInput = document.getElementById('fecha');
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            fechaInput.value = `${year}-${month}-${day}`;
        };
    </script>
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

    <!-- Formulario de agregar producto -->
    <div class="form-container">
        <h2>Agregar Producto</h2>
        <form action="baseproform.php" method="post">
            <label for="nombre_de_producto">Nombre del Producto:</label>
            <input type="text" id="nombre_de_producto" name="nombre_de_producto" required><br>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required><br>

            <label for="canti_stock">Cantidad en Stock:</label>
            <input type="number" id="canti_stock" name="canti_stock" required><br>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required><br>

            <input type="submit" value="Agregar Producto">
        </form>
    </div>

</body>
</html>
