<?php
ob_start();
require_once './includes/nav-login.php';

if (isset($_GET['id']))
{
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "'SELECT * FROM peliculas p "
            . "INNER JOIN temas_peliculas tp"
            . " ON p.id_temaPelicula = tp.id "
            . " WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $peliculas = mysqli_fetch_assoc($result);
    $imagenPelicula = $peliculas['imagen'];
    mysqli_free_result($result);
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
        $sql = "UPDATE peliculas SET id_temaPelicula = '$categoriapeli', titulo = '$titulopeli', "
                . "reparto = '$repartopeli', director = '$directorpeli', imagen = '$filename', descripcion = '$descripcion' "
                . "WHERE id = $id";
    } else
    {
         $sql = "UPDATE peliculas SET id_temaPelicula = '$categoriapeli', titulo = '$titulopeli', "
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
<<<<<<< HEAD
                    <label>Título</label>
                    <input class="form-control" type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($peliculas['titulo']); ?>" autofocus onchange="valtexto200('titulo')" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label>Reparto</label>
                    <input class="form-control" type="text" name="reparto" id="reparto" value="<?php echo htmlspecialchars($peliculas['reparto']); ?>" autofocus onchange="valtexto200('reparto')" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label>Director</label>
                    <input class="form-control ancho-disquera" type="text" name="director" id="director" value="<?php echo htmlspecialchars($peliculas['director']); ?>" autofocus onchange="valtexto200('director')" maxlength="200" required="">
                </div>
                <div class="form-group">
                    <label>Género</label>
                    <select class="form-control ancho-genero" name="genero" id="genero" value="<?php echo htmlspecialchars($peliculas['genero']); ?>" autofocus required>
                        <option value=" ">--Seleccionar--</option>
                         <?php
                         $sql= 'SELECT * FROM temas_peliculas';
                         $result= mysqli_query($conn, $sql);

                          while($categorias = mysqli_fetch_array($result))
                          echo "<option  value='".$categorias["id"]."'>".$categorias["genero"]."</option>";

                             ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea class="form-control altura-desc" id="descripcion" name="descripcion"  maxlength="16,777,215" onchange="valDesc('descripcion')" required><?php echo htmlspecialchars($peliculas['descripcion']); ?></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label>Imagen</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*" required>
=======
                    <label for="">Título</label>
                    <input class="form-control" type="text" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Reparto</label>
                    <input class="form-control" type="text" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="">Director</label>
                    <input class="form-control ancho-disquera" type="text" maxlength="200" required="">
                </div>
                <div class="form-group">
                    <label for="">Género</label>
                    <select class="form-control ancho-genero" required>
                        <optgroup label="Género">
                            <option value="1" selected="">Acción</option>
                        </optgroup>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control altura-desc" maxlength="16,777,215" required></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="">Imagen</label>
                    <input type="file" accept="image/" required>
>>>>>>> 60c2690d375b05f5f3a51849e624d6ed65ef2739
                </div>
                <div class="form-group d-flex justify-content-center">
                    <img class="ancho-imagen"  id="imagenSalida" src="<?= $base ?>imagenesAudifonos/<?php echo htmlspecialchars($peliculas['imagen']); ?>">
                </div>
                <input class="btn btn-info btn-block" type="submit" name="submit" value="Guardar cambios">
            </form>
        </div>
    </section>
</main>

<script>
function valtexto200(idinput){
  x = document.getElementById(idinput).value;
  if (validartexto200(x)) {
    document.getElementById(idinput).style.backgroundColor = "#CEF6D8";
  }else{
    document.getElementById(idinput).style.backgroundColor = "#F6CECE";
  }
}

function valDesc(idinput){
  x = document.getElementById(idinput).value;
  if (validardesc(x)) {
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
