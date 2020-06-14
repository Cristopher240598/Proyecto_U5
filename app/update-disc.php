<?php
ob_start();
require_once './includes/nav-login.php';

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM discos WHERE id = $id";
    $resultado = mysqli_query($conn, $sql);
    $discos = mysqli_fetch_assoc($resultado);
    $imagenDiscos = $discos['imagen'];
    mysqli_free_result($resultado);
}

if (isset($_POST['submit']) && isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $título = mysqli_real_escape_string($conn, $_POST['titulo']);
    $artista = mysqli_real_escape_string($conn, $_POST['artista']);
    $disquera = mysqli_real_escape_string($conn, $_POST['disquera']);
    $canciones = mysqli_real_escape_string($conn, $_POST['canciones']);
    $genero = mysqli_real_escape_string($conn, $_POST['genero']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    //Guardar la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != null)
    {
        unlink("imagenesDiscos/$imagenDiscos");
        $file = $_FILES['imagen'];
        $filename = $file['name'];
        $mimetype = $file['type'];
        if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' ||
                $mimetype == 'image/png' || $mimetype == 'image/gif')
        {
            if (!is_dir('imagenesDiscos'))
            {
                mkdir('imagenesDiscos', 0777, TRUE);
            }
            move_uploaded_file($file['tmp_name'], 'imagenesDiscos/' . $filename);
        }
        $sql = "UPDATE discos SET id_temaDisco = '$genero', titulo = '$título', artista = '$artista', "
                . "disquera = $disquera, numeroCanciones = $canciones, imagen = '$filename', descripcion = '$descripcion' "
                . "WHERE id = $id";
    } else
    {
        $sql = "UPDATE discos SET id_temaDisco = '$genero', titulo = '$título', artista = '$artista', "
                . "disquera = $disquera, numeroCanciones = '$canciones', descripcion = '$descripcion' "
                . "WHERE id = $id";
    }
    if (mysqli_query($conn, $sql))
    {
        header('Location: read-discs.php');
    } else
    {
        echo 'Error al actualizar disco, verifique query: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Modificar discos</h2>
            </div>
            <form class="formulario" action="update-disc.php?id=<?php echo $discos['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Título</label>
                    <input class="form-control ancho-marca" type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($discos['titulo']); ?>" maxlength="200" required autofocus>
                </div>
                <div class="form-group">
                    <label for="">Artista</label>
                    <input class="form-control ancho-artista" type="text" name="artista" id="artista" value="<?php echo htmlspecialchars($discos['artista']); ?>" maxlength="200" required autofocus>
                </div>
                <div class="form-group">
                    <label for="">Disquera</label>
                    <input class="form-control ancho-disquera" type="text" name="disquera" id="disquera" value="<?php echo htmlspecialchars($discos['disquera']); ?>" maxlength="200" required autofocus>
                </div>
                <div class="form-group">
                    <label for="">No. Canciones</label>
                    <input class="form-control ancho-peso" type="number" name="canciones" min="1" max="99" id="canciones" value="<?php echo htmlspecialchars($discos['numeroCanciones']); ?>" autofocus>
                </div>
                <div class="form-group">
                    <label for="genero">Género</label>
                    <select class="form-control ancho-genero" name="genero" id="genero" required="true">
                        <optgroup label="Géneros musicales">
                            <?php
                            $sqlGeneros = $mysqli->query("SELECT * FROM temas_discos");
                            while ($discosG = mysqli_fetch_array($sqlGeneros))
                            {
                                ?>
                            <option value="<?php echo htmlspecialchars($discosG['id']); ?>"> <?php echo htmlspecialchars($discosG['genero']); ?> </option>
                           <?php }
                                ?>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control altura-desc" name="descripcion" id="descripcion" autofocus><?php echo htmlspecialchars($discos['descripcion']); ?></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file" name="imagen" id="imagen" autofocus>
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen" id="imagenSalida" src="<?= $base ?>imagenesDiscos/<?php echo htmlspecialchars($discos['imagen']); ?>">
                </div>
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Guardar cambios">
            </form>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>  