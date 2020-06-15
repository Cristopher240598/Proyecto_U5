<?php
ob_start();
require_once './includes/nav-login.php';

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM peliculas WHERE id = $id";
    $resultado = mysqli_query($conn, $sql);
    $peliculas = mysqli_fetch_assoc($resultado);
    $imagenPelicula = $peliculas['imagen'];
    mysqli_free_result($resultado);

    $sql2 = 'SELECT * FROM temas_peliculas ORDER BY genero';
    $resultado = mysqli_query($conn, $sql2);
    $genPeliculas = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    mysqli_free_result($resultado);
}

if (isset($_POST['submit']) && isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $titulopeli = mysqli_real_escape_string($conn, $_POST['titulo']);
    $repartopeli = mysqli_real_escape_string($conn, $_POST['reparto']);
    $directorpeli = mysqli_real_escape_string($conn, $_POST['director']);
    $generopeli = mysqli_real_escape_string($conn, $_POST['genero']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    //Guardar la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['name'] != null)
    {
        unlink("imagenesPeliculas/$imagenAudifonos");
        $file = $_FILES['imagen'];
        $filename = $file['name'];
        $mimetype = $file['type'];
        if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' ||
                $mimetype == 'image/png' || $mimetype == 'image/gif')
        {
            if (!is_dir('imagenesPeliculas'))
            {
                mkdir('imagenesPeliculas', 0777, TRUE);
            }
            move_uploaded_file($file['tmp_name'], 'imagenesPeliculas/' . $filename);
        }
        $sql = "UPDATE peliculas SET id_temaPelicula = $generopeli, titulo = '$titulopeli', "
                . "reparto = '$repartopeli', director = '$directorpeli', imagen = '$filename', descripcion = '$descripcion' "
                . "WHERE id = $id";
    } else
    {
        $sql = "UPDATE peliculas SET id_temaPelicula = $generopeli, titulo = '$titulopeli', "
                . "reparto = '$repartopeli', director = '$directorpeli', descripcion = '$descripcion' "
                . "WHERE id = $id";
    }
    if (mysqli_query($conn, $sql))
    {
        header('Location: read-movies.php');
    } else
    {
        echo 'Error al actualizar peliculas: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Modificar película</h2>
            </div>
            <form class="formulario" enctype="multipart/form-data" action="update-movie.php?id=<?php echo $peliculas['id'] ?>" method="POST">
                <div class="form-group">
                    <label>Título</label>
                    <input class="form-control" type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($peliculas['titulo']); ?>" autofocus maxlength="200" required>
                </div>
                <div class="form-group">
                    <label>Reparto</label>
                    <input class="form-control" type="text" name="reparto" id="reparto" value="<?php echo htmlspecialchars($peliculas['reparto']); ?>" autofocus maxlength="200" required>
                </div>
                <div class="form-group">
                    <label>Director</label>
                    <input class="form-control ancho-disquera" type="text" name="director" id="director" value="<?php echo htmlspecialchars($peliculas['director']); ?>" autofocus maxlength="200" required="">
                </div>
                <div class="form-group">
                    <label>Género</label>
                    <select class="form-control ancho-genero" name="genero" id="genero" autofocus required>
                        <optgroup label="Género">
                            <?php foreach ($genPeliculas as $gen) { ?>
                                <?php if($gen['id'] == $peliculas['id_temaPelicula']) {?>
                                    <option value="<?php echo htmlspecialchars($gen['id']); ?>" selected><?php echo htmlspecialchars($gen['genero']); ?></option>
                                <?php } else {?>
                                    <option value="<?php echo htmlspecialchars($gen['id']); ?>"><?php echo htmlspecialchars($gen['genero']); ?></option>
                                <?php } ?>
                            <?php } ?>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea class="form-control altura-desc" id="descripcion" name="descripcion"  maxlength="16,777,215" required><?php echo htmlspecialchars($peliculas['descripcion']); ?></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label>Imagen</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*">
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen"  id="imagenSalida" src="<?= $base ?>imagenesPeliculas/<?php echo htmlspecialchars($peliculas['imagen']); ?>">
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