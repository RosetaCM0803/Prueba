<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Inicio de sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="contenedor">
        <div id="contenedorcentrado">
            <div id="login">
                <form id="loginform" class="formulario_Reg" action="validar.php" method="POST">
                    <label for="usuario">Correo electrónico</label>
                    <input class="usuario" id="usuario" type="text" name="usuario" placeholder="Correo" required="">
                    <label for="password">Contraseña</label>
                    <input class="password" id="password" type="password" placeholder="Contraseña" name="password" required="">
                    <button type="submit" id="Ingresar" name="Ingresar">Iniciar sesión</button>
                </form>
            </div>
            <div id="derecho">
                <div class="titulo">
                    SAE
                </div>
                <p>Sistema de Administración de Eventos</p>
                <hr>
                <div class="pie-form">
                    <a href="Vista_admin.php">Registro</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
