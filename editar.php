<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <link rel="icon" href="imag/Administrador.png">
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
        @media (max-width:720px) {
            header .logo-img{
                position: fixed;
                opacity: 1;
                background-color: #4dbdeb;
            }
            header .menu{
                top: 0px;
                position: fixed;
                color: var(--letras);
                font-size: 20px;
                left: 0;
                width: 100%;
                height: 100px;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #4dbdeb;
            }
        }
        * {
            margin: 0;
            padding: 0;
            border: none;
            box-sizing: border-box;
            list-style: none;
            font-family: "Roboto", sans-serif;
        }
        body {
            position: absolute;
            background: var(--fondo);
            background-size: cover;
            background-position: center;
            width: auto;
            height: auto;
            top: 120px;
            left: 15%;
        }
        header {
            position: fixed;
            z-index: 1;
            width: 100%;
            background-color: #31c9f7;
            padding: 0;
        }
        header .fondobarra {
            position: fixed;
            left: 0;
            top: 0;
            background-color: #31c9f7;
            height: 80px;
            width: 100%;
            display: flex;
            align-items: center;
            opacity: 1;
            box-shadow: 0 8px 32px 0 var(--colordifuminado);
        }
        header .logo-img {
            position: fixed;
            height: 80px;
            width: auto;
            left: 10%;
            top: 0;
        }
        header .menu {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 80px;
            background-color: #31c9f7;
        }
        .menu ul {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            width: 100%;
            background-color: #31c9f7;
        }
        .menu ul li {
            list-style-type: none;
            display: inline-block;
            margin-right: 20px;
        }
        .menu ul li:last-child {
            margin-right: 0;
        }
        .menu ul a {
            text-decoration: none;
            font-weight: bold;
            color: var(--letrasmenu);
        }
        .menu .list-item {
            padding: 10px;
            border-radius: 10px;
        }
        .menu ul .list-item.active a {
            background: rgb(255, 255, 255);
            border-radius: 10px;
            color: var(--letrasmenu);
            padding: 10px;
        }
        .contenedor {
            position: fixed;
            width: 70%;
            height: auto;
            left: 15%;
            top: 130px;
        }
        form {
            background: var(--colordifuminado);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form input[type="submit"] {
            background: var(--colorbotones);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        form input[type="submit"]:hover {
            background: var(--colorazul);
        }
        form input[type="button"] {
            background: var(--colorbotones);
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        form input[type="button"]:hover {
            background: var(--colorazul);
        }
    </style>
</head>
<body>
  <div class="contenedor">

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "prueba";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
      die("Error al conectar con la base de datos: " . $conn->connect_error);
  }

  $titulo = $descripcion = $lugar = $fecha = $id_usuario = "";

  $id_evento = isset($_GET["id"]) && is_numeric($_GET["id"]) ? (int)$_GET["id"] : null;

  if ($id_evento) {
      $stmt = $conn->prepare("SELECT * FROM evento WHERE id_evento = ?");
      $stmt->bind_param("i", $id_evento);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows == 1) {
          $row = $result->fetch_assoc();
          $titulo = htmlspecialchars($row["titulo"]);
          $descripcion = htmlspecialchars($row["descripcion"]);
          $lugar = htmlspecialchars($row["lugar"]);
          $fecha = $row["fecha"];
          $id_usuario = $row["id_usuario"];
      } else {
          echo "<p>No se encontró el evento especificado.</p>";
      }

      $stmt->close();
  } else {
      echo "<p>ID del evento no especificado o inválido.</p>";
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id_evento = $_POST["id_evento"];
      $titulo = htmlspecialchars($_POST["titulo"]);
      $descripcion = htmlspecialchars($_POST["descripcion"]);
      $lugar = htmlspecialchars($_POST["lugar"]);
      $fecha = $_POST["fecha"];
      $id_usuario = (int)$_POST["id_usuario"];

      $stmt = $conn->prepare("UPDATE evento SET titulo = ?, descripcion = ?, lugar = ?, fecha = ?, id_usuario = ? WHERE id_evento = ?");
      $stmt->bind_param("ssssii", $titulo, $descripcion, $lugar, $fecha, $id_usuario, $id_evento);

      if ($stmt->execute()) {
          echo "<p>Evento actualizado correctamente.</p>";
      } else {
          echo "<p>Error al actualizar el evento: " . $conn->error . "</p>";
      }

      $stmt->close();
  }

  $conn->close();
  ?>

  <header>
    <div class="fondobarra">
      <nav class="menu">
        <ul class="lista">
          <li class="list-item"><a href="Vista_Admin.php">Inicio</a></li>
          <li class="list-item"><a href="crearcuentas.php">Registrar</a></li>
          <li class="list-item active"><a href="revisar_event.php">Consultar</a></li>
          <li class="login">
          <a href="inicio.php" class="boton-login" type="submit">
            <span class="links-name">Salir</span>
          </a>
        </li>
        </ul>
      </nav>
    </div>
  </header>
  <form method="post" action="">
      <input type="hidden" name="id_evento" value="<?php echo $id_evento; ?>">

      <label for="titulo">Título:</label>
      <input type="text" name="titulo" value="<?php echo $titulo; ?>" required>

      <label for="descripcion">Descripción:</label>
      <input type="text" name="descripcion" value="<?php echo $descripcion; ?>" required>

      <label for="lugar">Lugar:</label>
      <input type="text" name="lugar" value="<?php echo $lugar; ?>" required>

      <label for="fecha">Fecha:</label>
      <input type="date" name="fecha" value="<?php echo $fecha; ?>" required>

      <label for="id_usuario">ID Usuario:</label>
      <input type="number" name="id_usuario" value="<?php echo $id_usuario; ?>" required>

      <input type="submit" value="Guardar cambios">
      <a href="revisar_event.php">
    <input type="button" value="Regresar" class="regresar-btn">
</a>

  </form>

  

  </div>
</body>
</html>
