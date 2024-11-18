<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos enviados desde el formulario
    $fknombre_de_producto = $_POST['fknombre_de_producto'];  // Nombre del producto
    $precio = $_POST['precio'];                               // Precio del producto (solo lectura)
    $vendidos = $_POST['vendidos'];                           // Cantidad vendida
    $fechaventa = $_POST['fechaventa'];                       // Fecha de la venta

    // Validar que los campos no estén vacíos
    if (!empty($fknombre_de_producto) && !empty($precio) && !empty($vendidos) && !empty($fechaventa)) {
        // Calcular el total (precio * vendidos)
        $total = $precio * $vendidos;

        // Consultar si el producto existe
        $sql = "SELECT * FROM productos WHERE nombre_de_producto = '$fknombre_de_producto'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Insertar los datos en la tabla ventas, incluyendo el total
            $insert_sql = "INSERT INTO ventas (fknombre_de_producto, fk_precio, vendidos, total, fechaventa) 
                           VALUES ('$fknombre_de_producto', '$precio', '$vendidos', '$total', '$fechaventa')";

            if ($conn->query($insert_sql) === TRUE) {
                // Redirigir a la página ventas.php después de la inserción exitosa
                header("Location: ventas.php");
                exit(); // Detener la ejecución del script después de la redirección
            } else {
                echo "<div class='error-message'>Error al registrar la venta: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='error-message'>El producto seleccionado no existe en la base de datos.</div>";
        }
    } else {
        echo "<div class='error-message'>Por favor, complete todos los campos.</div>";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
}
?>
