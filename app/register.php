<?php
ob_start();
require_once './includes/nav.php';

if (isset($_POST['submit']))
{
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $contrasenia = mysqli_real_escape_string($conn, $_POST['contrasenia']);
    //Guardar la imagen
    if (isset($_FILES['imagen']))
    {
        $file = $_FILES['imagen'];
        $filename = $file['name'];
        $mimetype = $file['type'];
        if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' ||
                $mimetype == 'image/png' || $mimetype == 'image/gif')
        {
            if (!is_dir('imagenesUsuario'))
            {
                mkdir('imagenesUsuario', 0777, TRUE);
            }
            move_uploaded_file($file['tmp_name'], 'imagenesUsuario/' . $filename);
        }
    }
    //Crear cuenta
    $sql = "INSERT INTO usuarios(nombre, usuario, contrasenia, rol, imagen) "
            . "VALUES('$nombre', '$usuario', '$contrasenia', 0, '$filename')";
    if (mysqli_query($conn, $sql))
    {
        /*
         * Iniciar sesión
         * rol 0: Usuario
         * rol 1: Administrador
         */
        $sql = "SELECT nombre, rol, imagen FROM usuarios "
                . "WHERE usuario = '$usuario' AND "
                . "contrasenia = '$contrasenia'";
        $resultado = mysqli_query($conn, $sql);
        if ($resultado->num_rows == 1)
        {
            session_start();
            $nombreUsuario = mysqli_fetch_assoc($resultado);
            $_SESSION['usuario'] = $nombreUsuario;
            if ($_SESSION['usuario']['rol'] == 0)
            {
                header('Location: discs.php');
            } else
            {
                header('Location: read-discs.php');
            }
        } else
        {
            header('Location: index.php');
        }
        mysqli_free_result($resultado);
    } else
    {
        echo 'Error en la creación de usuario: ' . mysqli_error($conn);
    }
}
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo">
                <h2 class="text-info tamanio-titulo">Registrarse</h2>
            </div>
            <form class="formulario" action="register.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
<<<<<<< HEAD
                    <input class="form-control" type="text" name="nombre" id="nombre" autofocus onchange="valtexto50('nombre')" maxlength="50" required>
=======
                    <input class="form-control" type="text" name="nombre" id="nombre" autofocus maxlength="50" required>
>>>>>>> 60c2690d375b05f5f3a51849e624d6ed65ef2739
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="imagen">Imagen</label>
                    <input type="file" accept="image/*" name="imagen" id="imagen" autofocus required>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" src="" id="imagenSalida">
                </div>
                <div class="form-group">
                    <label for="usuario">Correo electrónico</label>
<<<<<<< HEAD
                    <input class="form-control item" type="email" name="usuario" id="usuario" autofocus onchange="valemail('usuario')" maxlength="150" required>
                </div>
                <div class="form-group">
                    <label for="contrasenia">Contraseña</label>
                    <input class="form-control" type="password" name="contrasenia" id="contrasenia" onchange="valtexto255('contrasenia')" autofocus="" maxlength="255" required>
=======
                    <input class="form-control item" type="email" name="usuario" id="usuario" autofocus maxlength="150" required="">
                </div>
                <div class="form-group">
                    <label for="contrasenia">Contraseña</label>
                    <input class="form-control" type="password" name="contrasenia" id="contrasenia" autofocus="" maxlength="255">
>>>>>>> 60c2690d375b05f5f3a51849e624d6ed65ef2739
                </div>
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Registrarse">
            </form>
        </div>
    </section>
</main>

<script>

      function valemail(idinput){
        x = document.getElementById(idinput).value;
        if (validaremail(x)) {
          document.getElementById(idinput).style.backgroundColor = "#CEF6D8";
        }else{
          document.getElementById(idinput).style.backgroundColor = "#F6CECE";
        }
      }

      function valtexto255(idinput){
        x = document.getElementById(idinput).value;
        if (validartexto200(x)) {
          document.getElementById(idinput).style.backgroundColor = "#CEF6D8";
        }else{
          document.getElementById(idinput).style.backgroundColor = "#F6CECE";
        }
      }

      function valtexto50(idinput){
        x = document.getElementById(idinput).value;
        if (validartexto50(x)) {
          document.getElementById(idinput).style.backgroundColor = "#CEF6D8";
        }else{
          document.getElementById(idinput).style.backgroundColor = "#F6CECE";
        }
      }



</script>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>
