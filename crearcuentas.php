<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prueba"; // Cambia el nombre de la base de datos si es necesario

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $lugar = $_POST["lugar"];
    $fecha = $_POST["fecha"];
    $id_usuario = $_POST["id_usuario"];
    
    // Preparar la consulta SQL para insertar los datos en la tabla "evento"
    $sql = "INSERT INTO evento (titulo, descripcion, lugar, fecha, id_usuario)
            VALUES ('$titulo', '$descripcion', '$lugar', '$fecha', '$id_usuario')";
    
    // Ejecutar la consulta y verificar si se insertaron los datos correctamente
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Evento registrado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al registrar el evento: " . $conn->error . "');</script>";
    }
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>
<!--Inicio de barra de menu-->
<header>
    <img class="fondobarra">
    <div class="barra">
        <nav class="menu">
            <ul class="lista">
                <li class="list-item">
                    <a href="Vista_Admin.php">
                        <span class="links-name">Inicio</span>
                    </a>
                </li>
                <li class="list-item active">
                    <a href="crearcuentas.php">
                        <span class="links-name">Registrar</span>
                    </a>
                </li>
                <li class="list-item ">
                    <a href="revisar_event.php">
                        <span class="links-name">Consultar</span>
                    </a>
                </li>
                <li class="login">
          <a href="inicio.php" class="boton-login" type="submit">
            <span class="links-name">Salir</span>
          </a>
        </li>
            </ul>
        </nav>
    </div>
</header>
<body>
    <div class="img_fondo">
        <center>
            <img src="imag/logofondo.png" alt="" class="imagen_inicio">
        </center>
    </div>
    <div class="contenedor">
        <div class="registro">
            <h2>Registro de Eventos</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="titulo">Título:</label><br>
                <input type="text" name="titulo" required placeholder="TÍTULO"><br>
                <label for="descripcion">Descripción:</label><br>
                <input type="text" name="descripcion" required placeholder="DESCRIPCIÓN"><br>
                <label for="lugar">Lugar:</label><br>
                <input type="text" name="lugar" required placeholder="LUGAR"><br>
                <label for="fecha">Fecha:</label><br>
                <input type="date" name="fecha" required><br>
                <label for="id_usuario">ID Usuario:</label><br>
                <input type="number" name="id_usuario" required placeholder="ID USUARIO">
                <input type="submit" value="Registrar" class="boton-registrar">
            </form>
            </form>
        </div>
        
    </div>
</body>

</html>

<style>
    :root {
        --fondo: #f5f5f5;
        --letrasmenu: #171717;
        --letrasblack: #171717;
        --letraswhite: #ffffff;
        --letrasprimarias: #18345c;
        --letrassecundaria: #555555;
        --colorbotones: #498df3;
        --colorverde: #00bf62;
        --colorazul: #5271ff;
        --colordifuminado: #ffffff;
        --color2: #63f3ab;
        --color3: #31c9f7;
        --colortemporal: #ff0101;
    }

    @media (max-width: 720px) {
        header .logo-img {
            position: fixed;
            opacity: 1;
        }

        header .menu {
            top: -10px;
            position: fixed;
            color: var(--letras);
            font-size: 20px;
            left: 150px;
            width: auto;
            height: 100px;
            align-items: center;
            opacity: 0;
            pointer-events: none;
        }
    }

    /*Diseño principal*/
    * {
        margin: 0;
        padding: 0;
        border: none;
        box-sizing: border-box;
        list-style: none;
        font-family: "roboto", sans-serif;
    }

    /*Imagen en la pestaña*/
    .img-blanc {
        width: 50px;
        height: 30px;
        border-style: none;
        object-fit: cover;
    }

    /*Barra de Menu
header {
    display: flex;
    align-items: center;
    padding: 0 13px;
    background-image: url(../imag/credit.jpg);
    color: var(--letras);
    font-size: 20px;
    background-size: cover;
    background-position: center;
    height: 100px;
    width: auto;
}
*/
    header {
        /*background-image: var(--colortemporal);*/
        position: fixed;
        z-index: 1;
        background-color: #4dbdeb;
    }

    header .fondobarra {
        position: fixed;
        left: 0px;
        top: 0px;
        /*background-image:url(../imag/credit.jpg); */
        background-color: #4dbdeb;
        height: 80px;
        width: 100%;
        display: flex;
        align-items: center;
        background-size: cover;
        background-position: center;
        opacity: 1;
        box-shadow: 0 8px 32px 0 var(--colordifuminado);
    }

    header .logo-img {
        position: fixed;
        height: 80px;
        width: auto;
        left: 10%;
        top: 0px;
    }

    header .menu {
        top: 0px;
        position: fixed;
        color: var(--letrasmenu);
        font-size: 18px;
        left: 25%;
        width: 50%;
        height: 80px;
        align-items: center;
        padding: 0 20px 0 50px;
        text-align: center;
    }

    /*cuerpo*/
    body {
        /*background: url('../img/fondo.png') no-repeat;*/
        position: absolute;
        background: var(--fondo);
        background-size: cover;
        background-position: center;
        animation: animatebg 5s linear infinite;
        width: auto;
        height: auto;
        top: 120px;
        left: 20%;
    }

    .menu {
        display: flex;
        justify-content: space-between;
        width: 100%;
        padding-left: 10%;
        padding-right: 10%;
    }

    .menu ul {
        margin-top: 20px;
        margin: 0;
        padding: 0;
        width: auto;
        position: absolute;
        left: 15%;
    }

    .menu ul li {
        list-style-type: none;
        display: inline-block;
        margin-right: 20px;
        color: var(--letrasmenu);
    }

    .menu ul li:last-child {
        margin-right: 0;
        color: var(--letrasmenu);
    }

    .menu ul a {
        text-decoration: none;
        font-weight: bold;
        color: var(--letrasmenu);
        position: relative;
    }

    .menu .list-item {
        padding: 10px;
        border-radius: 10px;
    }

    .menu ul .list-item.active a {
        background: rgb(255, 255, 255);
        border-radius: 10px;
        color: var(--letrasmenu);
        text-align: center;
        padding: 10px;
        height: auto;
        width: auto;
    }

    .menu links-name {
        opacity: 0;
        pointer-events: none;
        color: var(--letrasmenu);
    }

    .menu.active links-name {
        opacity: 1;
        pointer-events: auto;
        transition: 0.3s ease;
        color: var(--letrasmenu);
    }

    .menu .login {
        background-color: var(--colorbotones);
        border: none;
        color: white;
        padding: 5px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 20px;
        transition-duration: 0.4s;
        right: 0px;
        cursor: pointer;
    }

    .img_fondo {
        position: fixed;
        width: 70%;
        left: 15%;
    }

    .imagen_inicio {
        width: auto;
        height: auto;
        opacity: 0.2;
        pointer-events: none;
    }

    .contenedor {
        position: fixed;
        height: auto;
        width: 70%;
        height: 60%;
        left: 15%;
        top: 130px;
    }

    .contenedor h2 {
        text-align: center;
    }

    .registro {
        position: relative;
        width: 70%;
        height: 130%;
        left: 15%;
        padding: 5px;
        font-size: 120%;
    }

    .registro input {
        position: relative;
        font-size: 20px;
        width: 80%;
        left: 10%;
    }

    .registro label {
        position: relative;
        font-size: 18px;
        left: 5%;
    }
    .boton-registrar {
        display: inline-block;
        background-color: var(--colorbotones);
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .boton-registrar:hover {
        background-color: var(--color2);
    }
    .registro input[type="text"],
    .registro input[type="number"],
    .registro input[type="email"] {
        width: 60%;
        padding: 5px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    /* Estilo para las etiquetas de los input */
    .registro label {
        font-size: 18px;
    }
    .boton-registrar {
        display: inline-block;
        background-color: var(--colorbotones);
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .boton-registrar:hover {
        background-color: var(--color2);
    }
    
</style>