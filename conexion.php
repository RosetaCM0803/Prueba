<?php
// Datos de conexión a la base de datos
$servername = "localhost";  // O usa '127.0.0.1'
$username = "root";         // Usuario predeterminado de XAMPP
$password = "";             // Contraseña predeterminada de XAMPP
$dbname = "evento";  // Nombre de tu base de datos

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
