<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: inicio.php");
    exit();
}

require_once 'conexion.php';

// Verificar el rol del usuario
$usuario_rol = $_SESSION['rol'];
$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM eventos";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Lista de Eventos</h2>
        <?php if ($usuario_rol == 1) { // Rol de superusuario ?>
            <a href="agregareventos.php" class="btn btn-success mb-3">Agregar Evento</a>
        <?php } ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Lugar</th>
                    <th>Fecha</th>
                    <?php if ($usuario_rol == 1) { ?>
                        <th>Acciones</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($evento = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $evento['Id']; ?></td>
                        <td><?php echo $evento['titulo']; ?></td>
                        <td><?php echo $evento['descripcion']; ?></td>
                        <td><?php echo $evento['lugar']; ?></td>
                        <td><?php echo $evento['fecha']; ?></td>
                        <?php if ($usuario_rol == 1) { ?>
                            <td>
                                <a href="editar_evento.php?id=<?php echo $evento['Id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="eliminar_evento.php?id=<?php echo $evento['Id']; ?>" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>