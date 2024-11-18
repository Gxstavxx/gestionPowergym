<?php
include 'conexion.php'; // Incluye la conexión a la base de datos

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_de_producto = $_POST['nombre_de_producto'];
    $precio = $_POST['precio'];
    $canti_stock = $_POST['canti_stock'];
    $fecha = $_POST['fecha']; // Fecha del formulario
    
    // Calcula el total multiplicando precio por cantidad de stock
    $total = $precio * $canti_stock;

    // Inserta los datos en la tabla 'productos', incluyendo el total calculado y la fecha
    $sql = "INSERT INTO productos (nombre_de_producto, precio, canti_stock, total, fecha) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiis", $nombre_de_producto, $precio, $canti_stock, $total, $fecha); // Añadir fecha al binding

    if ($stmt->execute()) {
        // Redirige al usuario a index.php si la inserción es exitosa
        header("Location: agregar.php");
        exit(); // Asegura que el script termine después de la redirección
    } else {
        echo "<div class='error-message'>Error al agregar el producto: " . $conn->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
