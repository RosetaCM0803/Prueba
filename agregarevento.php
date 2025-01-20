<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 1) { // 1 = ID del rol 'superusuario'
    header("Location: inicio.php");
    exit();
}

require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $lugar = mysqli_real_escape_string($conn, $_POST['lugar']);
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);

    $sql = "INSERT INTO eventos (titulo, descripcion, lugar, fecha, UsuarioId) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $titulo, $descripcion, $lugar, $fecha, $_SESSION['usuario_id']);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: eventos.php");
        exit();
    } else {
        echo "Error al agregar el evento: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Agregar Evento</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="mb-3">
                <label for="lugar" class="form-label">Lugar</label>
                <input type="text" class="form-control" id="lugar" name="lugar" required>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Guardar Evento</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
