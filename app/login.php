<?php
require_once './includes/nav.php';

if (isset($_POST['submit']))
{
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $contrasenia = mysqli_real_escape_string($conn, $_POST['contrasenia']);
    //Iniciar sesión
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
}
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo">
                <h2 class="text-info tamanio-titulo">Iniciar sesión</h2>
                <p class="tamanio-subtitulo">¡Bienvenido!</p>
            </div>
            <form class="formulario" action="login.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="usuario">Correo electrónico</label>
                    <input class="form-control item" type="email" name="usuario" id="usuario" autofocus>
                </div>
                <div class="form-group">
                    <label for="contrasenia">Contraseña</label>
                    <input class="form-control" type="password" name="contrasenia" id="contrasenia" autofocus>
                </div>
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Entrar">
            </form>
        </div>
    </section>
</main>

<?php require_once './includes/footer.php'; ?>  