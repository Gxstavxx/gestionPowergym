<?php
$servername = "localHost"; // Servidor, usualmente "localhost"
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña del usuario, usualmente en blanco para XAMPP
$database = "agua"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
