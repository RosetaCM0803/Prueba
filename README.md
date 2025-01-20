
# Sistema de Administración de Eventos (SAE)

Este proyecto es un sistema de administración de eventos que permite a los administradores gestionar usuarios y eventos. Está construido utilizando PHP y MySQL.

## Requisitos previos

- Tener instalado [XAMPP](https://www.apachefriends.org/es/index.html) o un servidor local similar (con soporte de PHP y MySQL).
- Un editor de código como [VSCode](https://code.visualstudio.com/) o cualquier otro editor de tu preferencia.
- Tener un navegador web para acceder a la interfaz del sistema.

## Instalación

1. **Clona o descarga el proyecto** en tu máquina local.
   - Si estás utilizando Git, puedes clonar el repositorio con el siguiente comando:
     ```bash
     git clone https://url-del-repositorio.git
     ```

2. **Crea una base de datos** en tu servidor MySQL local:
   - Abre phpMyAdmin o accede a MySQL desde la línea de comandos.
   - Crea una nueva base de datos llamada `prueba` (o cambia el nombre en el código según sea necesario).
     ```sql
     CREATE DATABASE prueba;
     ```

3. **Importa la estructura de la base de datos**:
   - Asegúrate de que la tabla `datos` exista en la base de datos `prueba` para almacenar los usuarios.
   - Puedes importar la siguiente estructura para la tabla `datos`:
     ```sql
     CREATE TABLE datos (
         id INT AUTO_INCREMENT PRIMARY KEY,
         correo VARCHAR(100) NOT NULL,
         contraseña VARCHAR(255) NOT NULL
     );
     ```

4. **Configura los detalles de la base de datos en `validar.php`**:
   - Abre el archivo `validar.php` y asegúrate de que la conexión a la base de datos esté configurada correctamente:
     ```php
     $servername = "localhost";
     $username = "root";
     $password_db = "";  // Contraseña de la base de datos (si está configurada)
     $dbname = "prueba";  // Nombre de la base de datos
     ```

5. **Inicia el servidor de Apache y MySQL**:
   - Si estás utilizando XAMPP, abre el panel de control y ejecuta Apache y MySQL.

## Cómo acceder al sistema

1. Abre tu navegador y navega a `http://localhost/` o `http://localhost/nombre-del-directorio/` donde hayas ubicado el proyecto.
2. Accede al sistema con las credenciales preestablecidas. Si aún no tienes un usuario, regístralo desde la vista de administración.

## Archivos principales

- **inicio.php**: Página de inicio de sesión donde los usuarios ingresan su correo electrónico y contraseña para acceder al sistema.
- **validar.php**: Procesa la validación del inicio de sesión. Verifica las credenciales del usuario.
- **Vista_admin.php**: Página principal del administrador, que se muestra después de un inicio de sesión exitoso.
- **crearcuentas.php**: Página para registrar nuevos usuarios en el sistema.

## Cómo cambiar los elementos

### Cambiar el nombre de la base de datos

1. Abre el archivo `validar.php`.
2. Localiza la línea:
   ```php
   $dbname = "prueba";  // Nombre de la base de datos
   ```
3. Cambia `"prueba"` por el nuevo nombre de la base de datos que desees utilizar.

### Cambiar el diseño de la interfaz (CSS)

1. Los estilos del sistema se encuentran en el archivo `css/style.css`.
2. Abre el archivo `style.css` y realiza los cambios de estilo que desees, como colores, tamaños de fuente, etc.

### Agregar un nuevo campo al formulario de inicio de sesión

1. Abre el archivo `inicio.php`.
2. Si deseas agregar un nuevo campo al formulario (por ejemplo, un campo de "nombre de usuario"), agrega el HTML correspondiente dentro de la etiqueta `<form>`:
   ```html
   <label for="nombre_usuario">Nombre de usuario</label>
   <input id="nombre_usuario" type="text" name="nombre_usuario" placeholder="Nombre de usuario" required="">
   ```

3. Luego, abre `validar.php` y modifica el código para que procese el nuevo campo.

### Cambiar el contenido de la página de administración

1. Abre el archivo `Vista_admin.php`.
2. Modifica el mensaje de bienvenida, la interfaz de administración o agrega nuevas funcionalidades.

