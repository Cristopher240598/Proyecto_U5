<?php
ob_start();
require_once './includes/nav-login.php';

if (isset($_POST['submit']))
{
    $titulopeli = mysqli_real_escape_string($conn, $_POST['titulo']);
    $repartopeli = mysqli_real_escape_string($conn, $_POST['reparto']);
    $directorpeli = mysqli_real_escape_string($conn, $_POST['director']);
    $categoriapeli = mysqli_real_escape_string($conn, $_POST['genero']);
    $descripcionpeli = mysqli_real_escape_string($conn, $_POST['descripcion']);
    //Guardar la imagen
    if (isset($_FILES['imagen']))
    {
        $archivo = $_FILES['imagen'];
        $filename = $archivo['name'];
        $mimetype = $archivo['type'];
        if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' ||
                $mimetype == 'image/png' || $mimetype == 'image/gif')
        {
            if (!is_dir('imagenesPeliculas'))
            {
                mkdir('imagenesPeliculas', 0777, TRUE);
            }
            move_uploaded_file($archivo['tmp_name'], 'imagenesPeliculas/' . $filename);
        }
    }
    $sql = "INSERT INTO peliculas(id_temaPelicula, titulo, reparto , director, imagen, descripcion ) "
            . "VALUES('$categoriapeli', '$titulopeli', '$repartopeli', '$directorpeli', '$filename', '$descripcion')";
    if (mysqli_query($conn, $sql))
    {
        header('Location: read-movies.php');
    } else
    {
        echo 'Error en la insercción de pelicula: ' . mysqli_error($conn);
    }

    <!--
    ssss
    -->
}

?>

<main class="principal principal-1">
    <section>
        <div class="container">
            <div class="text-center block-heading padding-titulo-formularios">
                <h2 class="text-info tamanio-titulo">Crear película</h2>
            </div>
            <form class="formulario" enctype="multipart/form-data" action="create-movie.php" method="POST">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input id="titulo" name="titulo" class="form-control" type="text" value="<?php echo htmlspecialchars($titulopeli) ?>" autofocus="autofocus" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="reparto">Reparto</label>
                    <input id="reparto" name="reparto" class="form-control" type="text" value="<?php echo htmlspecialchars($repartopeli) ?>" maxlength="200" required>
                </div>
                <div class="form-group">
                    <label for="director">Director</label>
                    <input id="director" name="director" class="form-control ancho-disquera" type="text" value="<?php echo htmlspecialchars($directorpeli) ?>" maxlength="200" required="">
               </div>
                <div class="form-group">
                    <label for="genero">Género</label>
                    <select id="genero" name="genero" class="form-control ancho-genero" value="<?php echo htmlspecialchars($categoriapeli) ?>" required>
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
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control altura-desc"  maxlength="16,777,215" required><?php echo htmlspecialchars($descripcionpeli) ?></textarea>
                </div>
                <div class="form-group d-flex flex-column">
                    <label for="imagen">Imagen</label>
                    <input id="imagen" name="imagen" type="file" value="<?php echo htmlspecialchars($filename) ?>" accept="image/*" required>
                </div>
           </form>
        </div>
    </section>
</main>

<?php
ob_end_flush();
require_once './includes/footer.php';
?>
